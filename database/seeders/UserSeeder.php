<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Administrator', 'email' => 'admin@spkwisata.id', 'role' => UserRole::Administrator],
            ['name' => 'Adi', 'email' => 'adi@admin.com', 'password' => 'adi123', 'role' => UserRole::Administrator],
            ['name' => 'Verifikator', 'email' => 'verif@spkwisata.id', 'role' => UserRole::Verifikator],
            ['name' => 'Administrative', 'email' => 'admin2@spkwisata.id', 'role' => UserRole::Administrative],
        ];

        foreach ($users as $user) {
            User::query()->updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => $user['password'] ?? 'password',
                    'role' => $user['role'],
                ],
            );
        }
    }
}
