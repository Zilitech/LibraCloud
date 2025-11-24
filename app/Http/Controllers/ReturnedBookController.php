<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnedBook;
use App\Models\IssuedBook;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ReturnedBookController extends Controller
{
    // Display all returned books
    public function index()
    {
        $returnedBooks = ReturnedBook::orderBy('created_at', 'desc')->get();
        return view('returned_books', compact('returnedBooks'));
    }

    // Delete a returned book record
    public function destroy($id)
    {
        $returnedBook = ReturnedBook::findOrFail($id);
        $returnedBook->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Returned Book',
            'details' => "Deleted returned book: {$returnedBook->book_name} of member: {$returnedBook->member_name}",
            'status'  => 'success'
        ]);

        return redirect()->back()->with('success', 'Returned book record deleted successfully.');
    }

    // Re-issue a returned book
    public function reissue($id)
    {
        $returnedBook = ReturnedBook::findOrFail($id);

        // Store in issued_books table
        IssuedBook::create([
            'issue_id' => $returnedBook->issue_id,
            'member_name' => $returnedBook->member_name,
            'book_name' => $returnedBook->book_name,
            'book_isbn' => $returnedBook->book_isbn,
            'author_name' => $returnedBook->author_name,
            'issue_date' => now()->toDateString(),
            'due_date' => $returnedBook->due_date,
            'quantity' => $returnedBook->quantity,
            'status' => 'Issued',
            'remarks' => $returnedBook->remarks,
        ]);

        // Delete from returned_books table
        $returnedBook->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Reissue Returned Book',
            'details' => "Re-issued book: {$returnedBook->book_name} to member: {$returnedBook->member_name}",
            'status'  => 'success'
        ]);

        return redirect()->back()->with('success', 'Book re-issued successfully!');
    }

    // Return a book from issued_books
    public function returnBook(Request $request)
    {
        $issueId = $request->id;   // book.id from button

        // Find issued book
        $issuedBook = IssuedBook::find($issueId);

        if (!$issuedBook) {
            return response()->json(['error' => 'Issued book not found'], 404);
        }

        // Insert into returned_books table
        ReturnedBook::create([
            'issue_id'     => $issuedBook->issue_id,
            'member_name'  => $issuedBook->member_name,
            'book_name'    => $issuedBook->book_name,
            'book_isbn'    => $issuedBook->book_isbn,
            'author_name'  => $issuedBook->author_name,
            'issue_date'   => $issuedBook->issue_date,
            'due_date'     => $issuedBook->due_date,
            'quantity'     => $issuedBook->quantity,
            'status'       => 'Returned',
            'remarks'      => 'Book returned successfully',
        ]);

        // Delete from issued_books table
        $issuedBook->delete();

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Return Book',
            'details' => "Book returned: {$issuedBook->book_name} by member: {$issuedBook->member_name}",
            'status'  => 'success'
        ]);

        return response()->json(['success' => 'Book returned successfully']);
    }
}
