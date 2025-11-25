<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fine;
use App\Models\OverdueBook;
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

        // Ensure numeric member_id and book_id
        $memberId = is_numeric($overdueBook->member_id) ? (int)$overdueBook->member_id : null;
        $bookId   = is_numeric($overdueBook->book_id) ? (int)$overdueBook->book_id : null;

        if (!$memberId || !$bookId) {
            return redirect()->route('fines.index')
                ->with('error', 'Cannot mark as paid: Missing or invalid member_id or book_id.');
        }

        // Calculate fine properly
        $daysOverdue = max(0, $overdueBook->days_overdue);
        $fineAmount  = max(0, $daysOverdue * 10); // ₹10 per day

        // Create fine record
        $fine = Fine::create([
            'fine_id'      => 'FINE-' . str_pad($overdueBook->id, 4, '0', STR_PAD_LEFT),
            'member_id'    => $memberId,
            'book_id'      => $bookId,
            'issue_date'   => $overdueBook->issue_date,
            'due_date'     => $overdueBook->due_date,
            'return_date'  => now(),
            'days_overdue' => $daysOverdue,
            'fine_amount'  => $fineAmount,
            'status'       => 'Paid',
            'college_id'   => 1
        ]);

        // Update overdue book status
        $overdueBook->status = 'Paid';
        $overdueBook->save();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Mark Fine Paid',
            'details' => 'Fine ID: ' . $fine->id . ' created from Overdue Book ID: ' . $overdueBook->id,
            'status'  => 'success',
        ]);

        return redirect()->route('fines.index')
            ->with('success', 'Fine created and marked as paid.');
    }

    // Delete fine
    public function destroy($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Fine',
            'details' => 'Fine ID: ' . $id . ' deleted',
            'status'  => 'success',
        ]);

        return redirect()->route('fines.index')->with('success', 'Fine deleted successfully.');
    }
}
