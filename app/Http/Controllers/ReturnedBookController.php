<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReturnedBook;
use App\Models\IssuedBook;

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

        return redirect()->back()->with('success', 'Book re-issued successfully!');
    }
}
