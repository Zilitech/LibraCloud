<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Models\OverdueBook;
use App\Models\ReturnedBook;
use Carbon\Carbon;

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
            $daysOverdue = $today->diffInDays(Carbon::parse($book->due_date));
            $fine = $daysOverdue * 10; // ₹10 per day

            OverdueBook::updateOrCreate(
                ['issue_id' => $book->issue_id],
                [
                    'book_name' => $book->book_name,
                    'member_name' => $book->member_name,
                    'member_id' => $book->member_id ?? null,
                    'issue_date' => $book->issue_date,
                    'due_date' => $book->due_date,
                    'days_overdue' => $daysOverdue,
                    'fine' => $fine,
                    'status' => 'Overdue'
                ]
            );
        }
    }

    // Mark book as returned (no CSRF check required)
    public function markAsReturned($issue_id)
    {
        try {
            $issuedBook = IssuedBook::where('issue_id', $issue_id)->firstOrFail();
            $overdueBook = OverdueBook::where('issue_id', $issue_id)->first();

            ReturnedBook::create([
                'issue_id'    => $issuedBook->issue_id,
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

            $issuedBook->delete();
            if ($overdueBook) $overdueBook->delete();

            return response()->json(['status' => 'success', 'message' => 'Book marked as returned']);

        } catch (\Exception $e) {
            \Log::error('Mark returned error: '.$e->getMessage());
            return response()->json(['status' => 'error', 'message' => 'Something went wrong: '.$e->getMessage()], 500);
        }
    }
}
