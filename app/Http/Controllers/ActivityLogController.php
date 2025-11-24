<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;


class ActivityLogController extends Controller
{
    public function index()
    {
        // Fetch all logs
        $logs = ActivityLog::with('user')->orderBy('created_at', 'desc')->get();

        // Fetch unique users for dropdown
        $users = ActivityLog::select('user_id')
                    ->with('user')
                    ->distinct()
                    ->get()
                    ->map(function ($item) {
                        return $item->user; // return related user model
                    })
                    ->filter(); // remove null values

        return view('activity_log', compact('logs', 'users'));
    }

    // AJAX fetch for filters
    public function fetchLogs(Request $request)
    {
        $query = ActivityLog::with('user')->orderBy('created_at', 'desc');

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->action) {
            $query->where('action', $request->action);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $logs = $query->get();

        $data = [];
        foreach ($logs as $log) {
            $data[] = [
                'id' => $log->id,
                'user' => $log->user->name ?? 'N/A',
                'action' => $log->action,
                'details' => $log->details,
                'created_at' => $log->created_at->format('Y-m-d h:i A'),
                'status' => $log->status == 'success'
                    ? '<span class="badge bg-success">Success</span>'
                    : '<span class="badge bg-danger">Failed</span>'
            ];
        }

        return response()->json(['data' => $data]);
    }
}
