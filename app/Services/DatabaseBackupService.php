<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Process;
use PDO;
use RuntimeException;

class DatabaseBackupService
{
    public function create(): string
    {
        $connection = config('database.default');
        $config = config("database.connections.{$connection}");

        $backupDir = storage_path('app/backups');

        if (! File::isDirectory($backupDir)) {
            File::makeDirectory($backupDir, 0755, true);
        }

        $filename = 'backup_'.now()->format('Y-m-d_His').'.sql';
        $filepath = $backupDir.DIRECTORY_SEPARATOR.$filename;

        if ($config['driver'] === 'mysql') {
            $this->backupMysql($config, $filepath);
        } elseif ($config['driver'] === 'sqlite') {
            $this->backupSqlite($config, $filepath);
        } else {
            throw new RuntimeException('Driver database tidak didukung untuk backup.');
        }

        if (! file_exists($filepath) || filesize($filepath) === 0) {
            $this->removeFile($filepath);

            throw new RuntimeException('Backup database gagal: file backup kosong.');
        }

        return $filepath;
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function backupMysql(array $config, string $filepath): void
    {
        $errors = [];

        try {
            $this->backupMysqlWithMysqldump($config, $filepath);

            return;
        } catch (RuntimeException $exception) {
            $errors[] = $exception->getMessage();
            $this->removeFile($filepath);
        }

        try {
            $this->backupMysqlWithPhp($config, $filepath);

            return;
        } catch (RuntimeException $exception) {
            $errors[] = $exception->getMessage();
            $this->removeFile($filepath);
        }

        throw new RuntimeException('Backup database gagal: '.implode(' | ', $errors));
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function backupMysqlWithMysqldump(array $config, string $filepath): void
    {
        if (PHP_OS_FAMILY !== 'Windows') {
            $this->runMysqldumpToStdout($config, $filepath);

            return;
        }

        $this->runMysqldumpViaShell($config, $filepath);
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function runMysqldumpViaShell(array $config, string $filepath): void
    {
        $mysqldump = $this->findMysqldump();
        $host = $this->resolveMysqlHost((string) ($config['host'] ?? '127.0.0.1'));
        $port = (string) ($config['port'] ?? '3306');
        $username = (string) ($config['username'] ?? 'root');
        $password = (string) ($config['password'] ?? '');
        $database = (string) $config['database'];

        $command = sprintf(
            '"%s" --host=%s --port=%s --user=%s --single-transaction --routines --triggers %s',
            $mysqldump,
            $host,
            $port,
            $username,
            $database,
        );

        $descriptorSpec = [
            0 => ['pipe', 'r'],
            1 => ['pipe', 'w'],
            2 => ['pipe', 'w'],
        ];

        $env = $_ENV;

        if ($password !== '') {
            $env['MYSQL_PWD'] = $password;
        }

        $process = proc_open(['cmd', '/c', $command], $descriptorSpec, $pipes, base_path(), $env);

        if (! is_resource($process)) {
            throw new RuntimeException('Tidak dapat menjalankan mysqldump.');
        }

        fclose($pipes[0]);
        $stdout = stream_get_contents($pipes[1]);
        $stderr = stream_get_contents($pipes[2]);
        fclose($pipes[1]);
        fclose($pipes[2]);

        $exitCode = proc_close($process);

        if ($exitCode !== 0 || $stdout === '') {
            throw new RuntimeException(trim($stderr ?: 'mysqldump tidak menghasilkan output.'));
        }

        File::put($filepath, $stdout);
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function runMysqldumpToStdout(array $config, string $filepath): void
    {
        $mysqldump = $this->findMysqldump();
        $host = $this->resolveMysqlHost((string) ($config['host'] ?? '127.0.0.1'));
        $port = (string) ($config['port'] ?? '3306');
        $username = (string) ($config['username'] ?? 'root');
        $password = (string) ($config['password'] ?? '');
        $database = (string) $config['database'];

        $process = Process::timeout(120);

        if ($password !== '') {
            $process = $process->env(['MYSQL_PWD' => $password]);
        }

        $result = $process->run([
            $mysqldump,
            '--host='.$host,
            '--port='.$port,
            '--user='.$username,
            '--single-transaction',
            '--routines',
            '--triggers',
            $database,
        ]);

        if (! $result->successful() || $result->output() === '') {
            throw new RuntimeException(trim($result->errorOutput() ?: $result->output() ?: 'mysqldump gagal.'));
        }

        File::put($filepath, $result->output());
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function backupMysqlWithPhp(array $config, string $filepath): void
    {
        $database = (string) $config['database'];
        $pdo = DB::connection()->getPdo();

        $lines = [
            '-- Navara Database Backup',
            '-- Generated: '.now()->toDateTimeString(),
            '-- Method: PHP/PDO',
            '',
            'SET FOREIGN_KEY_CHECKS=0;',
            'SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";',
            'SET time_zone = "+00:00";',
            '',
        ];

        $tables = $pdo->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            $createTable = $pdo->query("SHOW CREATE TABLE `{$table}`")->fetch(PDO::FETCH_ASSOC);

            $lines[] = "DROP TABLE IF EXISTS `{$table}`;";
            $lines[] = $createTable['Create Table'].';';
            $lines[] = '';

            $rows = $pdo->query("SELECT * FROM `{$table}`")->fetchAll(PDO::FETCH_ASSOC);

            if ($rows === []) {
                continue;
            }

            $columns = array_keys($rows[0]);
            $columnList = implode(', ', array_map(fn (string $column) => "`{$column}`", $columns));

            foreach ($rows as $row) {
                $values = implode(', ', array_map(
                    fn (mixed $value) => $this->quoteValue($pdo, $value),
                    array_values($row),
                ));

                $lines[] = "INSERT INTO `{$table}` ({$columnList}) VALUES ({$values});";
            }

            $lines[] = '';
        }

        $lines[] = 'SET FOREIGN_KEY_CHECKS=1;';
        $lines[] = '';

        File::put($filepath, implode(PHP_EOL, $lines));
    }

    private function quoteValue(PDO $pdo, mixed $value): string
    {
        if ($value === null) {
            return 'NULL';
        }

        return $pdo->quote((string) $value);
    }

    /**
     * @param  array<string, mixed>  $config
     */
    private function backupSqlite(array $config, string $filepath): void
    {
        $source = $config['database'];

        if (! file_exists($source)) {
            throw new RuntimeException('File database SQLite tidak ditemukan.');
        }

        if (! copy($source, $filepath)) {
            throw new RuntimeException('Gagal menyalin file database SQLite.');
        }
    }

    private function resolveMysqlHost(string $host): string
    {
        return in_array(strtolower($host), ['localhost', '::1'], true) ? '127.0.0.1' : $host;
    }

    private function findMysqldump(): string
    {
        $laragonMatches = glob('C:\\laragon\\bin\\mysql\\*\\bin\\mysqldump.exe') ?: [];

        foreach ($laragonMatches as $path) {
            if (file_exists($path)) {
                return $path;
            }
        }

        $result = Process::run(['where', 'mysqldump']);

        if ($result->successful()) {
            return trim(explode("\n", $result->output())[0]);
        }

        throw new RuntimeException('mysqldump tidak ditemukan. Pastikan MySQL/Laragon terinstal.');
    }

    private function removeFile(string $filepath): void
    {
        if (file_exists($filepath)) {
            @unlink($filepath);
        }
    }
}
