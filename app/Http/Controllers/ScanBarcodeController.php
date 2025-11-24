<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Models\Member;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

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

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Scan ISBN',
            'details' => "Scanned ISBN '{$isbn}' - Found {$issuedBooks->count()} issued book(s)",
            'status'  => 'success'
        ]);

        return response()->json($issuedBooks);
    }

    public function index()
    {
        // Fetch all members from DB
        $all_members = Member::select('id', 'member_id', 'fullname', 'phone')->get();

        // Pass to Blade
        return view('scan_barcode', compact('all_members'));
    }

    public function returnBook(Request $request)
    {
        // Placeholder logic for returning book (existing functionality)
        // You can add the real return logic if needed

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Return Book',
            'details' => 'Book return processed via barcode scan',
            'status'  => 'success'
        ]);

        return response()->json(['status' => 'success']);
    }
}
