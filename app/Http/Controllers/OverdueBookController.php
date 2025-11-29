<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Models\Member;
use App\Models\OverdueBook;
use App\Models\ReturnedBook;
use App\Models\ActivityLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationTemplate;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;

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
        $issuedBook = IssuedBook::where('issue_id', $issue_id)->first();
        if (!$issuedBook) {
            return response()->json([
                'status' => 'error',
                'message' => 'Issued book not found or already returned.'
            ], 404);
        }

        $overdueBook = OverdueBook::where('issue_id', $issue_id)->first();

        $returnedBook = ReturnedBook::create([
            'issue_id'    => $issuedBook->issue_id,
            'member_id'   => $issuedBook->member_id,
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

        // -------------------------
        // Send email (Returned Book event) BEFORE deleting
        // -------------------------
        try {
            MailHelper::applyEmailSettings();
            $member = Member::where('memberid', $returnedBook->member_id)->first();

            if ($member && $member->email) {
                $template = NotificationTemplate::where('event_name', 'Returned Book')->first();

                if ($template) {
                    $messageBody = $template->message;

                    $messageBody = str_replace('{{member_name}}', $member->fullname, $messageBody);
                    $messageBody = str_replace('{{book_title}}', $returnedBook->book_name, $messageBody);
                    $messageBody = str_replace('{{book_no}}', $returnedBook->book_isbn ?? '', $messageBody);
                    $messageBody = str_replace('{{issue_date}}', $returnedBook->issue_date, $messageBody);
                    $messageBody = str_replace('{{due_date}}', $returnedBook->due_date, $messageBody);
                    $messageBody = str_replace('{{today_date}}', now()->toDateString(), $messageBody);
                    $messageBody = str_replace('{{fine}}', $overdueBook->fine ?? 0, $messageBody);
                    $messageBody = str_replace('{{overdue_days}}', $overdueBook->days_overdue ?? 0, $messageBody);

                    Mail::html(nl2br($messageBody), function ($msg) use ($member) {
                        $msg->to($member->email)
                            ->subject('Book Returned Notification');
                    });
                }
            }
        } catch (\Exception $e) {
            \Log::error("Returned book email failed: " . $e->getMessage());
        }

        // Delete issued and overdue records AFTER email
        $issuedBook->delete();
        if ($overdueBook) $overdueBook->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Return Overdue Book',
            'details' => "Book returned: {$returnedBook->book_name} by member: {$returnedBook->member_name} ({$returnedBook->member_id}). Overdue fine: " . ($overdueBook->fine ?? 0),
            'status'  => 'success'
        ]);

        return response()->json(['status' => 'success', 'message' => 'Book marked as returned']);

    } catch (\Exception $e) {
        \Log::error('Mark returned error: ' . $e->getMessage());
        return response()->json(['status' => 'error', 'message' => 'Something went wrong: ' . $e->getMessage()], 500);
    }
}


}
