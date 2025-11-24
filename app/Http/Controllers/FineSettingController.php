<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FineSetting;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class FineSettingController extends Controller
{
    /**
     * Show the fine settings form.
     */
    public function index()
    {
        $fineSetting = FineSetting::first();
        return view('fine_settings.index', compact('fineSetting'));
    }

    /**
     * Save or update fine settings.
     */
    public function store(Request $request)
    {
        $request->validate([
            'due_days' => 'required|integer|min:1',
            'overdue_start' => 'required|integer|min:0',
            'daily_fine' => 'required|numeric|min:0',
            'max_fine' => 'nullable|numeric|min:0',
        ]);

        FineSetting::updateOrCreate(
            ['id' => 1], // only one record
            [
                'due_days' => $request->due_days,
                'overdue_start' => $request->overdue_start,
                'daily_fine' => $request->daily_fine,
                'max_fine' => $request->max_fine,
            ]
        );

        // Activity log
        ActivityLog::create([
            'user_id' => Auth::id(), // optional: null if no user logged in
            'action'  => 'Update Fine Settings',
            'details' => 'Due Days: '.$request->due_days.', Overdue Start: '.$request->overdue_start.', Daily Fine: '.$request->daily_fine.', Max Fine: '.$request->max_fine,
            'status'  => 'success',
        ]);

        return redirect()->back()->with('success', 'Fine settings updated successfully!');
    }
}
