<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Book;
use App\Models\IssuedBook;
use Illuminate\Support\Str;
use App\Models\ReturnedBook;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationTemplate;
use App\Helpers\MailHelper;
use Illuminate\Support\Facades\Mail;

class IssueBookController extends Controller
{
    // Show form to issue a book
    public function create()
    {
        $members = Member::all();
        $books = Book::all();

        // Generate unique issue ID
        do {
            $issue_id = 'ISS' . strtoupper(Str::random(6));
        } while (IssuedBook::where('issue_id', $issue_id)->exists());

        return view('issue', compact('members', 'books', 'issue_id'));
    }

    // Store issued book
    public function store(Request $request)
{
    // 1️⃣ Validate request
    $validated = $request->validate([
        'issue_id' => 'required|unique:issued_books,issue_id',
        'member_id' => 'required|exists:members,memberid',
        'member_name' => 'required|string',
        'book_name' => 'required|string',
        'book_isbn' => 'required|string',
        'author_name' => 'required|string',
        'issue_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:issue_date',
        'quantity' => 'required|integer|min:1',
    ]);

    // 2️⃣ Check book availability
    $book = Book::where('isbn', $request->book_isbn)->first();
    if (!$book) {
        return response()->json(['status' => 'error', 'message' => 'Book not found!']);
    }

    if ($request->quantity > $book->quantity) {
        return response()->json(['status' => 'error', 'message' => 'Requested quantity exceeds available stock!']);
    }

    // 3️⃣ Decrement book quantity
    $book->decrement('quantity', $request->quantity);

    // 4️⃣ Create issued book record
    $issuedBook = IssuedBook::create([
        'issue_id' => $request->issue_id,
        'member_id' => $request->member_id,
        'member_name' => $request->member_name,
        'book_name' => $request->book_name,
        'book_isbn' => $request->book_isbn,
        'author_name' => $request->author_name,
        'issue_date' => $request->issue_date,
        'due_date' => $request->due_date,
        'quantity' => $request->quantity,
        'status' => $request->status ?? 'Issued',
        'remarks' => $request->remarks,
    ]);

    // 5️⃣ Log activity
    ActivityLog::create([
        'user_id' => Auth::id(),
        'action' => 'Issue Book',
        'details' => 'Book: ' . $request->book_name . 
                     ' | Member: ' . $request->member_name .
                     ' | Member ID: ' . $request->member_id .
                     ' | Quantity: ' . $request->quantity,
        'status' => 'success',
    ]);

    // 6️⃣ Send issued book email
    try {
        MailHelper::applyEmailSettings(); // load SMTP dynamically
        $member = Member::where('memberid', $request->member_id)->first();

        if ($member && $member->email) {
            $template = NotificationTemplate::where('event_name', 'Issued Book')->first();
            if ($template) {
                $messageBody = $template->message;
                $messageBody = str_replace('{{member_name}}', $member->fullname, $messageBody);
                $messageBody = str_replace('{{book_title}}', $request->book_name, $messageBody);
                $messageBody = str_replace('{{book_no}}', $request->book_isbn, $messageBody);
                $messageBody = str_replace('{{issue_date}}', $request->issue_date, $messageBody);
                $messageBody = str_replace('{{due_date}}', $request->due_date, $messageBody);

                // ✅ Send HTML email using Mail::html()
                Mail::html(nl2br($messageBody), function ($msg) use ($member) {
                    $msg->to($member->email)
                        ->subject('Book Issued Notification');
                });
            }
        }if ($member && $member->email) {
    $template = NotificationTemplate::where('event_name', 'Issued Book')->first();

    if ($template) {
        $messageBody = $template->message;
        $messageBody = str_replace('{{member_name}}', $member->fullname, $messageBody);
        $messageBody = str_replace('{{book_title}}', $request->book_name, $messageBody);
        $messageBody = str_replace('{{book_no}}', $request->book_isbn, $messageBody);
        $messageBody = str_replace('{{issue_date}}', $request->issue_date, $messageBody);
        $messageBody = str_replace('{{due_date}}', $request->due_date, $messageBody);

        try {
            Mail::html($messageBody, function ($msg) use ($member) {
                $msg->to($member->email)
                    ->subject('Book Issued Notification');
            });
        } catch (\Exception $e) {
            \Log::error("Issued book email failed: " . $e->getMessage());
        }
    }
}
    } catch (\Exception $e) {
        \Log::error("Issued book email failed: " . $e->getMessage());
        // Optional: You can also return email failure in JSON
        // return response()->json(['status' => 'warning', 'message' => 'Book issued but email failed to send!']);
    }

    // 7️⃣ Return JSON for AJAX (display on same page)
    return response()->json([
        'status' => 'success',
        'message' => 'Book issued successfully and email sent!',
        'issued_book' => $issuedBook
    ]);
}



    // List all issued books
    public function index()
    {
        $issuedBooks = IssuedBook::orderBy('created_at', 'desc')->get();
        return view('issue_book', compact('issuedBooks'));
    }

    // Delete an issued book
    public function destroy($id)
    {
        $issuedBook = IssuedBook::findOrFail($id);

        $book = Book::where('isbn', $issuedBook->book_isbn)->first();
        if ($book) {
            $book->quantity += $issuedBook->quantity;
            $book->save();
        }

        $issuedBook->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Delete Issued Book',
            'details' => 'Book: ' . ($book->book_title ?? 'Unknown') . 
                         ' | Member: ' . $issuedBook->member_name . 
                         ' | Member ID: ' . $issuedBook->member_id,
            'status' => 'success',
        ]);

        return redirect()->back()->with('success', 'Issued book deleted successfully!');
    }

    // Return an issued book
    public function returnBook($id)
    {
        $issuedBook = IssuedBook::findOrFail($id);

        ReturnedBook::create([
            'issue_id' => $issuedBook->issue_id,
            'member_id' => $issuedBook->member_id,
            'member_name' => $issuedBook->member_name,
            'book_name' => $issuedBook->book_name,
            'book_isbn' => $issuedBook->book_isbn,
            'author_name' => $issuedBook->author_name,
            'issue_date' => $issuedBook->issue_date,
            'due_date' => $issuedBook->due_date,
            'quantity' => $issuedBook->quantity,
            'status' => 'Returned',
            'remarks' => $issuedBook->remarks,
        ]);

        $book = Book::where('isbn', $issuedBook->book_isbn)->first();
        if ($book) {
            $book->quantity += $issuedBook->quantity;
            $book->save();
        }

        $issuedBook->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => 'Return Book',
            'details' => 'Book: ' . ($book->book_title ?? 'Unknown') .
                         ' | Member: ' . $issuedBook->member_name . 
                         ' | Member ID: ' . $issuedBook->member_id .
                         ' | Quantity: ' . $issuedBook->quantity,
            'status' => 'success',
        ]);

        return redirect()->back()->with('success', 'Book returned successfully!');
    }

    public function getBookByBarcode($barcode)
    {
        $books = IssuedBook::where('id', $barcode)->get();
        
        if($books->count() > 0){
            return response()->json([
                'success' => true,
                'book' => $books->map(function($book){
                    return [
                        'id' => $book->id,
                        'name' => $book->book_name,
                        'author' => $book->author_name,
                        'issue' => $book->issue_date,
                        'due' => $book->due_date,
                        'status' => $book->status,
                    ];
                })
            ]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
