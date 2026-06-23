<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Alternatif;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalUsers' => User::query()->count(),
            'totalAlternatif' => Alternatif::query()->count(),
            'totalLogs' => ActivityLog::query()->count(),
            'recentLogs' => ActivityLog::query()
                ->with('user')
                ->latest('created_at')
                ->limit(5)
                ->get(),
        ]);
    }
}
