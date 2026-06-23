<?php

use App\Http\Controllers\Admin\ActivityLogController;
use App\Http\Controllers\Admin\BackupController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Administrative\DashboardController as AdministrativeDashboardController;
use App\Http\Controllers\Administrative\MooraController as AdministrativeMooraController;
use App\Http\Controllers\Administrative\NilaiAlternatifController as AdministrativeNilaiAlternatifController;
use App\Http\Controllers\Administrative\ObjekWisataController as AdministrativeObjekWisataController;
use App\Http\Controllers\Administrative\RankingController as AdministrativeRankingController;
use App\Http\Controllers\Verifikator\DashboardController as VerifikatorDashboardController;
use App\Http\Controllers\Verifikator\KriteriaController as VerifikatorKriteriaController;
use App\Http\Controllers\Verifikator\RankingController as VerifikatorRankingController;
use App\Http\Controllers\WisataController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WisataController::class, 'index'])->name('wisata.index');
Route::get('/wisata/{alternatif}', [WisataController::class, 'show'])->name('wisata.show');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::redirect('akun-pengguna', '/admin/users')->name('accounts.index');

        Route::resource('users', UserController::class)->except(['show']);

        Route::get('activity-logs', [ActivityLogController::class, 'index'])->name('activity-logs.index');
        Route::get('activity-logs/{activityLog}', [ActivityLogController::class, 'show'])->name('activity-logs.show');

        Route::get('backup', [BackupController::class, 'index'])->name('backup.index');
        Route::post('backup', [BackupController::class, 'store'])->name('backup.store');
        Route::get('backup/download/{filename}', [BackupController::class, 'download'])->name('backup.download');
    });

Route::middleware(['auth', 'verifikator'])
    ->prefix('verifikator')
    ->name('verifikator.')
    ->group(function () {
        Route::get('/', [VerifikatorDashboardController::class, 'index'])->name('dashboard');

        Route::resource('kriteria', VerifikatorKriteriaController::class)->except(['show']);

        Route::get('ranking', [VerifikatorRankingController::class, 'index'])->name('ranking.index');
        Route::get('ranking/unduh', [VerifikatorRankingController::class, 'download'])->name('ranking.download');
    });

Route::middleware(['auth', 'administrative'])
    ->prefix('administrative')
    ->name('administrative.')
    ->group(function () {
        Route::get('/', [AdministrativeDashboardController::class, 'index'])->name('dashboard');

        Route::resource('objek-wisata', AdministrativeObjekWisataController::class)
            ->parameters(['objek-wisata' => 'alternatif'])
            ->except(['show']);

        Route::get('alternatif/{alternatif}/baris/edit', [AdministrativeNilaiAlternatifController::class, 'editRow'])->name('alternatif.edit-row');
        Route::put('alternatif/{alternatif}/baris', [AdministrativeNilaiAlternatifController::class, 'updateRow'])->name('alternatif.update-row');
        Route::delete('alternatif/{alternatif}/baris', [AdministrativeNilaiAlternatifController::class, 'destroyRow'])->name('alternatif.destroy-row');

        Route::resource('alternatif', AdministrativeNilaiAlternatifController::class)
            ->parameters(['alternatif' => 'nilaiAlternatif'])
            ->except(['show']);

        Route::get('moora', [AdministrativeMooraController::class, 'index'])->name('moora.index');

        Route::get('ranking', [AdministrativeRankingController::class, 'index'])->name('ranking.index');
        Route::get('ranking/unduh', [AdministrativeRankingController::class, 'download'])->name('ranking.download');
    });
