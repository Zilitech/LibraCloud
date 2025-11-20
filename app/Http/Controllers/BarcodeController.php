<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    // Load page
    public function index()
    {
        $books = Book::all();
return view('generate_barcode', compact('books'));    }

    // Ajax details for selected book
    public function bookData(Request $request)
    {
        $book = Book::find($request->id);

        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        return response()->json($book);
    }

    public function getByBarcode($code)
{
    $book = Book::where('isbn', $code)->orWhere('book_code', $code)->first();

    if (!$book) {
        return response()->json(['success' => false]);
    }

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
