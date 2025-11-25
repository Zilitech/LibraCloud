<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fine;
use App\Models\OverdueBook;
use App\Models\ReturnedBook;
use App\Models\FineSetting;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class FineController extends Controller
{
    // Show Fine Management page
    public function index()
    {
        $all_overdue = OverdueBook::all();

        return view('fine_management', compact('all_overdue'));

    }
    // Mark fine as paid
    public function markAsPaid($id)
{
    // Get the overdue book
    $overdueBook = OverdueBook::findOrFail($id);

    // Create a new fine record
    $fine = Fine::create([
        'fine_id'      => 'FINE-' . str_pad($overdueBook->id, 4, '0', STR_PAD_LEFT),
        'member_id'    => $overdueBook->member_id,
        'book_id'      => $overdueBook->book_id,
        'issue_date'   => $overdueBook->issue_date,
        'due_date'     => $overdueBook->due_date,
        'return_date'  => now(),
        'days_overdue' => $overdueBook->days_overdue,
        'fine_amount'  => $overdueBook->fine,
        'status'       => 'Paid',
        'college_id'   => 1 // Or get dynamically if needed
    ]);

    // Optional: Update the overdue book status
    $overdueBook->status = 'Paid';
    $overdueBook->save();

    // Log activity
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'Mark Fine Paid',
        'details' => 'Fine ID: ' . $fine->id . ' created from Overdue Book ID: ' . $overdueBook->id,
        'status' => 'success',
    ]);

    return redirect()->route('fines.index')->with('success', 'Fine created and marked as paid.');
}


    // Delete fine
    public function destroy($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Fine',
            'details' => 'Fine ID: ' . $id . ' deleted',
            'status' => 'success',
        ]);

        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully.');
    }
}
