<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\ActivityLogService;
use App\Services\DatabaseBackupService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use RuntimeException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class BackupController extends Controller
{
    public function index(): View
    {
        $backupDir = storage_path('app/backups');
        $backups = [];

        if (File::isDirectory($backupDir)) {
            $backups = collect(File::files($backupDir))
                ->filter(fn ($file) => $file->getSize() > 0)
                ->sortByDesc(fn ($file) => $file->getMTime())
                ->take(10)
                ->map(fn ($file) => [
                    'name' => $file->getFilename(),
                    'size' => $file->getSize(),
                    'date' => date('d M Y H:i', $file->getMTime()),
                ])
                ->values()
                ->all();
        }

        return view('admin.backup.index', [
            'backups' => $backups,
        ]);
    }

    public function store(DatabaseBackupService $backupService, ActivityLogService $activityLog): RedirectResponse
    {
        try {
            $filepath = $backupService->create();
            $filename = basename($filepath);

            $activityLog->log(auth()->user(), "Backup database: {$filename}");

            return redirect()
                ->route('admin.backup.index')
                ->with('success', 'Backup berhasil. File: '.$filename);
        } catch (RuntimeException $exception) {
            return back()->with('error', $exception->getMessage());
        }
    }

    public function download(string $filename): BinaryFileResponse|RedirectResponse
    {
        $filepath = storage_path('app/backups/'.basename($filename));

        if (! file_exists($filepath)) {
            return back()->with('error', 'File backup tidak ditemukan.');
        }

        return response()->download($filepath);
    }
}
