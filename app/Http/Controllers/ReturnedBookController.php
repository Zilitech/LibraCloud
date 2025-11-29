<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnedBook;
use App\Models\IssuedBook;
use App\Models\Member;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationTemplate;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;

class ReturnedBookController extends Controller
{
    public function index()
    {
        $returnedBooks = ReturnedBook::orderBy('created_at', 'desc')->get();
        return view('returned_books', compact('returnedBooks'));
    }

    public function destroy($id)
    {
        $returnedBook = ReturnedBook::findOrFail($id);
        $returnedBook->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Returned Book',
            'details' => "Deleted returned book: {$returnedBook->book_name} of member: {$returnedBook->member_name} ({$returnedBook->member_id})",
            'status'  => 'success'
        ]);

        return redirect()->back()->with('success', 'Returned book record deleted successfully.');
    }



   public function reissue($id)
{
    $returnedBook = ReturnedBook::findOrFail($id);

    // Create Issued Book
    $issuedBook = IssuedBook::create([
        'issue_id'    => $returnedBook->issue_id,
        'member_id'   => $returnedBook->member_id,
        'member_name' => $returnedBook->member_name,
        'book_name'   => $returnedBook->book_name,
        'book_isbn'   => $returnedBook->book_isbn,
        'author_name' => $returnedBook->author_name,
        'issue_date'  => now()->toDateString(),
        'due_date'    => $returnedBook->due_date,
        'quantity'    => $returnedBook->quantity,
        'status'      => 'Issued',
        'remarks'     => $returnedBook->remarks,
    ]);

    // Delete returned book
    $returnedBook->delete();

    // Log activity
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action'  => 'Reissue Returned Book',
        'details' => "Re-issued book: {$issuedBook->book_name} to member: {$issuedBook->member_name} ({$issuedBook->member_id})",
        'status'  => 'success'
    ]);

    // -------------------------
    // Send email (Issued Book event)
    // -------------------------
    try {
        MailHelper::applyEmailSettings(); // load SMTP dynamically

        // Fetch member from returnedBook's member_id
        $member = Member::where('memberid', $returnedBook->member_id)->first();

        if (!$member) {
            \Log::warning("Reissue email not sent: Member not found for ID {$returnedBook->member_id}");
        }

        if ($member && $member->email) {
            $template = NotificationTemplate::where('event_name', 'Issued Book')->first();

            if ($template) {
                $messageBody = $template->message;

                // Replace template variables
                $messageBody = str_replace('{{member_name}}', $member->fullname, $messageBody);
                $messageBody = str_replace('{{book_title}}', $issuedBook->book_name, $messageBody);
                $messageBody = str_replace('{{book_no}}', $issuedBook->book_isbn, $messageBody);
                $messageBody = str_replace('{{issue_date}}', $issuedBook->issue_date, $messageBody);
                $messageBody = str_replace('{{due_date}}', $issuedBook->due_date, $messageBody);
                $messageBody = str_replace('{{today_date}}', now()->toDateString(), $messageBody);

                try {
                    Mail::html(nl2br($messageBody), function ($msg) use ($member) {
                        $msg->to($member->email)
                            ->subject('Book Issued Notification');
                    });
                } catch (\Exception $e) {
                    \Log::error("Reissue email failed to {$member->email}: " . $e->getMessage());
                }
            }
        } else {
            \Log::warning("Reissue email not sent: Member email is empty for ID {$returnedBook->member_id}");
        }

    } catch (\Exception $e) {
        \Log::error("Reissue email process failed: " . $e->getMessage());
    }

    return redirect()->back()->with('success', 'Book re-issued successfully!');
}


    public function returnBook(Request $request)
    {
        $issueId = $request->id;
        $issuedBook = IssuedBook::find($issueId);

        if (!$issuedBook) {
            return response()->json(['error' => 'Issued book not found'], 404);
        }

        ReturnedBook::create([
            'issue_id'    => $issuedBook->issue_id,
            'member_id'   => $issuedBook->member_id, // added
            'member_name' => $issuedBook->member_name,
            'book_name'   => $issuedBook->book_name,
            'book_isbn'   => $issuedBook->book_isbn,
            'author_name' => $issuedBook->author_name,
            'issue_date'  => $issuedBook->issue_date,
            'due_date'    => $issuedBook->due_date,
            'quantity'    => $issuedBook->quantity,
            'status'      => 'Returned',
            'remarks'     => 'Book returned successfully',
        ]);

        $issuedBook->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Return Book',
            'details' => "Book returned: {$issuedBook->book_name} by member: {$issuedBook->member_name} ({$issuedBook->member_id})",
            'status'  => 'success'
        ]);


        try {

    MailHelper::applyEmailSettings(); // Load SMTP dynamically

    // Get member details
    $member = Member::where('memberid', $issuedBook->member_id)->first();

    if ($member && $member->email) {

        $template = NotificationTemplate::where('event_name', 'Returned Book')->first();

        if ($template) {

            // Replace template variables
            $messageBody = $template->message;
            $messageBody = str_replace('{{member_name}}', $member->fullname, $messageBody);
            $messageBody = str_replace('{{book_title}}', $issuedBook->book_name, $messageBody);
            $messageBody = str_replace('{{book_no}}', $issuedBook->book_isbn, $messageBody);
            $messageBody = str_replace('{{issue_date}}', $issuedBook->issue_date, $messageBody);
            $messageBody = str_replace('{{due_date}}', $issuedBook->due_date, $messageBody);

            // Send email
            Mail::html(nl2br($messageBody), function ($msg) use ($member) {
                $msg->to($member->email)
                    ->subject('Book Returned Notification');
            });
        }
    }

} catch (\Exception $e) {
    \Log::error("Returned book email failed: " . $e->getMessage());
}


        return response()->json(['success' => 'Book returned successfully']);
    }
}
