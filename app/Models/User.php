<?php

namespace App\Models;

use App\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
        ];
    }

    public function activityLogs(): HasMany
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function hasilPerhitungan(): HasMany
    {
        return $this->hasMany(HasilPerhitungan::class, 'created_by');
    }

    public function dashboardUrl(): string
    {
        return match ($this->role) {
            UserRole::Administrator => route('admin.dashboard'),
            UserRole::Verifikator => route('verifikator.dashboard'),
            UserRole::Administrative => route('administrative.dashboard'),
            default => route('wisata.index'),
        };
    }
}
