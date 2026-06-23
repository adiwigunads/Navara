<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\View\View;

class ActivityLogController extends Controller
{
    public function index(): View
    {
        return view('admin.activity-logs.index', [
            'logs' => ActivityLog::query()
                ->with('user')
                ->latest('created_at')
                ->paginate(15),
        ]);
    }

    public function show(ActivityLog $activityLog): View
    {
        $activityLog->load('user');

        return view('admin.activity-logs.show', [
            'log' => $activityLog,
        ]);
    }
}
