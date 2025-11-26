<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Models\OverdueBook;
use App\Models\ReturnedBook;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class OverdueBookController extends Controller
{
    // Show Overdue Books
    public function index()
    {
        $this->updateOverdueBooks(); // update overdue records
        $overdueBooks = OverdueBook::orderBy('days_overdue', 'desc')->get();
        return view('overdue', compact('overdueBooks'));
    }

    // Update overdue books
    public function updateOverdueBooks()
    {
        $today = Carbon::now()->startOfDay();

        $issuedBooks = IssuedBook::where('status', 'Issued')
            ->whereDate('due_date', '<', $today)
            ->get();

        foreach ($issuedBooks as $book) {
            // Calculate days overdue
            $daysOverdue = $today->diffInDays(Carbon::parse($book->due_date));
            
            // Fine calculation: ₹10 per day overdue
            $fine = $daysOverdue * 10;

            OverdueBook::updateOrCreate(
                ['issue_id' => $book->issue_id],
                [
                    'book_id'      => $book->book_id ?? null,
                    'book_name'    => $book->book_name,
                    'member_id'    => $book->member_id ?? null,
                    'member_name'  => $book->member_name,
                    'issue_date'   => $book->issue_date,
                    'due_date'     => $book->due_date,
                    'days_overdue' => $daysOverdue,
                    'fine'         => $fine,
                    'status'       => 'Overdue'
                ]
            );

            // Log activity
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action'  => 'Update Overdue',
                'details' => "Updated overdue book: {$book->book_name} for member: {$book->member_name}, Days overdue: $daysOverdue, Fine: ₹$fine",
                'status'  => 'success'
            ]);
        }
    }

    // Mark book as returned
    // Mark book as returned
public function markAsReturned($issue_id)
{
    try {
        $issuedBook = IssuedBook::where('issue_id', $issue_id)->firstOrFail();
        $overdueBook = OverdueBook::where('issue_id', $issue_id)->first();

        ReturnedBook::create([
            'issue_id'    => $issuedBook->issue_id,
            'member_id'   => $issuedBook->member_id, // <-- Added this
            'member_name' => $issuedBook->member_name,
            'book_name'   => $issuedBook->book_name,
            'book_isbn'   => $issuedBook->book_isbn ?? null,
            'author_name' => $issuedBook->author_name ?? null,
            'issue_date'  => $issuedBook->issue_date,
            'due_date'    => $issuedBook->due_date,
            'quantity'    => $issuedBook->quantity ?? 1,
            'status'      => 'Returned',
            'remarks'     => $overdueBook ? "Overdue: ₹{$overdueBook->fine}, Days: {$overdueBook->days_overdue}" : null
        ]);

        // Delete issued and overdue record
        $issuedBook->delete();
        if ($overdueBook) $overdueBook->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Return Overdue Book',
            'details' => "Book returned: {$issuedBook->book_name} by member: {$issuedBook->member_name} ({$issuedBook->member_id}). Overdue fine: " . ($overdueBook->fine ?? 0),
            'status'  => 'success'
        ]);

        return response()->json(['status' => 'success', 'message' => 'Book marked as returned']);

    } catch (\Exception $e) {
        \Log::error('Mark returned error: '.$e->getMessage());
        return response()->json(['status' => 'error', 'message' => 'Something went wrong: '.$e->getMessage()], 500);
    }
}
}
