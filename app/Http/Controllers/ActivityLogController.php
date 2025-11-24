<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    // Load main activity log page
    public function index(Request $request)
    {
        // Build query for activity logs
        $query = ActivityLog::with('user');

        // Apply filters if present (for non-AJAX page load)
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        // Get logs ordered by latest
        $logs = $query->orderBy('created_at', 'desc')->get();

        // Fetch unique users for dropdown
        $users = ActivityLog::with('user')
                    ->select('user_id')
                    ->distinct()
                    ->get()
                    ->map(fn($item) => $item->user)
                    ->filter(); // remove null values

        return view('activity_log', compact('logs', 'users'));
    }

    // AJAX fetch for DataTable filters
    public function fetchLogs(Request $request)
{
    $query = ActivityLog::with('user');

    if ($request->user_id) {
        $query->where('user_id', $request->user_id);
    }

    if ($request->action) {
        $query->where('action', $request->action);
    }

    if ($request->date) {
        $query->whereDate('created_at', $request->date);
    }

    $total = $query->count();

    $logs = $query->orderBy('created_at', 'desc')->get();

    $data = [];
    foreach ($logs as $log) {
        $data[] = [
            'id' => $log->id,
            'user' => $log->user->name ?? 'System',
            'action' => $log->action,
            'details' => $log->details,
            'status' => $log->status === 'success'
                ? '<span class="badge bg-success">Success</span>'
                : '<span class="badge bg-danger">Failed</span>',
            'created_at' => $log->created_at->format('Y-m-d h:i A'),
        ];
    }

    return response()->json([
        'draw' => intval($request->input('draw')),
        'recordsTotal' => $total,
        'recordsFiltered' => $total,
        'data' => $data,
    ]);
}

}
