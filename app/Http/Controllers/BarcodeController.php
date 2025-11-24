<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarcodeController extends Controller
{
    // Load page
    public function index()
    {
        $books = Book::all();
        return view('generate_barcode', compact('books'));
    }

    // Ajax details for selected book
    public function bookData(Request $request)
    {
        $book = Book::find($request->id);

        if (!$book) {
            // Log failed view attempt
            ActivityLog::create([
                'user_id' => Auth::id(), // optional user
                'action'  => 'View Book Details',
                'details' => 'Failed to view book details. Book ID: ' . $request->id,
                'status'  => 'failed',
            ]);

            return response()->json(['error' => 'Book not found'], 404);
        }

        // Log successful view
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'View Book Details',
            'details' => 'Viewed book details: ' . $book->book_title,
            'status'  => 'success',
        ]);

        return response()->json($book);
    }

    // Get book by barcode
    public function getByBarcode($code)
    {
        $book = Book::where('isbn', $code)->orWhere('book_code', $code)->first();

        if (!$book) {
            // Log failed barcode search
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action'  => 'Search Book By Barcode',
                'details' => 'Failed barcode search. Code: ' . $code,
                'status'  => 'failed',
            ]);

            return response()->json(['success' => false]);
        }

        // Log successful barcode search
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Search Book By Barcode',
            'details' => 'Found book via barcode: ' . $book->book_title . ' (Code: ' . $code . ')',
            'status'  => 'success',
        ]);

        return response()->json([
            'success' => true,
            'book' => [
                'book_title'    => $book->book_title,
                'author_name'   => $book->author_name,
                'category_name' => $book->category_name,
                'quantity'      => $book->quantity,
                'available'     => $book->available,
                'issued'        => $book->issued,
                'price'         => $book->price,
                'isbn'          => $book->isbn,
                'book_code'     => $book->book_code,
            ]
        ]);
    }
}
