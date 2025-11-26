<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnedBook;
use App\Models\IssuedBook;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

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

        IssuedBook::create([
            'issue_id' => $returnedBook->issue_id,
            'member_id' => $returnedBook->member_id, // added
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

        $returnedBook->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Reissue Returned Book',
            'details' => "Re-issued book: {$returnedBook->book_name} to member: {$returnedBook->member_name} ({$returnedBook->member_id})",
            'status'  => 'success'
        ]);

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

        return response()->json(['success' => 'Book returned successfully']);
    }
}
