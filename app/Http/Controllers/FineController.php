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
        // Fetch fine settings
        $fineSetting = FineSetting::first();
        $dailyFine = $fineSetting->daily_fine ?? 10; // Default ₹10/day
        $overdueStart = $fineSetting->overdue_start ?? 0; // Days grace period
        $maxFine = $fineSetting->max_fine ?? 9999; // Max fine limit

        // Fetch all overdue books
        $overdueBooks = OverdueBook::all();

        $fines = $overdueBooks->map(function ($book) use ($dailyFine, $overdueStart, $maxFine) {
            // Only filter by issue_id
            $returnBook = ReturnedBook::where('issue_id', $book->issue_id)->first();

            $returnDate = $returnBook ? Carbon::parse($returnBook->return_date) : now();
            $dueDate = Carbon::parse($book->due_date);

            $daysOverdue = max(0, $returnDate->diffInDays($dueDate) - $overdueStart);
            $fineAmount = min($daysOverdue * $dailyFine, $maxFine);

            // Safely handle null relationships
            $memberName = $book->member ? $book->member->name : 'Unknown Member';
            $memberCode = $book->member ? $book->member->member_code : 'N/A';
            $bookTitle = $book->book ? $book->book->title : 'Unknown Book';

            return [
                'id' => $book->id,
                'fine_id' => 'FINE-' . str_pad($book->id, 4, '0', STR_PAD_LEFT),
                'member' => $memberName . ' (' . $memberCode . ')',
                'book_title' => $bookTitle,
                'issue_date' => $book->issue_date,
                'due_date' => $book->due_date,
                'return_date' => $returnDate,
                'days_overdue' => $daysOverdue,
                'fine_amount' => $fineAmount,
                'status' => $fineAmount > 0 ? 'Pending' : 'Paid',
            ];
        });

        return view('fine_management', compact('fines'));
    }

    // Mark fine as paid
    public function markAsPaid($id)
    {
        $fine = Fine::findOrFail($id);
        $fine->status = 'Paid';
        $fine->save();

        // Activity log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Mark Fine Paid',
            'details' => 'Fine ID: ' . $fine->id . ' marked as Paid for Member ID: ' . ($fine->member_id ?? 'N/A'),
            'status' => 'success',
        ]);

        return redirect()->route('fines.index')->with('success', 'Fine marked as paid.');
    }
}
