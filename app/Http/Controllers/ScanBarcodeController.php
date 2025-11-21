<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Models\Member;

class ScanBarcodeController extends Controller
{
    // Fetch issued books by ISBN
    public function getIssuedBooks(Request $request)
    {
        $isbn = $request->isbn;

        if (!$isbn) {
            return response()->json(['error' => 'ISBN is required'], 400);
        }

        // Fetch all issued books matching the ISBN
        $issuedBooks = IssuedBook::where('book_isbn', $isbn)
                        ->where('status', 'Issued') // optional filter
                        ->get();

        if ($issuedBooks->isEmpty()) {
            return response()->json(['error' => 'No issued book found for this ISBN'], 404);
        }

        return response()->json($issuedBooks);
    }



}
