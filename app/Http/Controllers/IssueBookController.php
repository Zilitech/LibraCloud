<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Book;
use App\Models\IssuedBook;
use Illuminate\Support\Str;
use App\Models\ReturnedBook;

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
    $validated = $request->validate([
        'issue_id' => 'required|unique:issued_books,issue_id',
        'member_name' => 'required|string',
        'book_name' => 'required|string',
        'book_isbn' => 'required|string',
        'author_name' => 'required|string',
        'issue_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:issue_date',
        'quantity' => 'required|integer|min:1',
    ]);

    $book = Book::where('isbn', $request->book_isbn)->first();
    if (!$book) {
        return response()->json(['status' => 'error', 'message' => 'Book not found!']);
    }

    if ($request->quantity > $book->quantity) {
        return response()->json(['status' => 'error', 'message' => 'Requested quantity exceeds available stock!']);
    }

    $book->decrement('quantity', $request->quantity);

    IssuedBook::create([
        'issue_id' => $request->issue_id,
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

    return response()->json(['status' => 'success', 'message' => 'Book issued successfully!']);
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

        // Restore quantity back to books table
        $book = Book::where('isbn', $issuedBook->book_isbn)->first();
        if ($book) {
            $book->quantity += $issuedBook->quantity;
            $book->save();
        }

        $issuedBook->delete();

        return redirect()->back()->with('success', 'Issued book deleted successfully!');
    }

    // Return an issued book
    public function returnBook($id)
    {
        $issuedBook = IssuedBook::findOrFail($id);

        // Store in returned_books table
        ReturnedBook::create([
            'issue_id' => $issuedBook->issue_id,
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

        // Restore quantity in books table
        $book = Book::where('isbn', $issuedBook->book_isbn)->first();
        if ($book) {
            $book->quantity += $issuedBook->quantity;
            $book->save();
        }

        // Delete from issued_books
        $issuedBook->delete();

        return redirect()->back()->with('success', 'Book returned successfully!');
    }

     public function getBookByBarcode($barcode)
{
    // Fetch issued book(s) by ID or barcode
    $books = IssuedBook::where('id', $barcode)->get(); // or ->where('barcode', $barcode)
    
    if($books->count() > 0){
        return response()->json([
            'success' => true,
            'book' => $books->map(function($book){
                return [
                    'id' => $book->id,
                    'name' => $book->book_name,
                    'author' => $book->author,
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
