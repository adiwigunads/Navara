<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Models\User;

class ActivityLogService
{
    public function log(User $user, string $action): ActivityLog
    {
        return ActivityLog::query()->create([
            'user_id' => $user->id,
            'action' => $action,
            'created_at' => now(),
        ]);
    }
}
