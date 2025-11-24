<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $details = null, $status = 'success', $user_id = null)
    {
        ActivityLog::create([
            'user_id' => $user_id ?? Auth::id(), // default to logged-in user
            'action' => $action,
            'details' => $details,
            'status' => $status,
        ]);
    }
}
