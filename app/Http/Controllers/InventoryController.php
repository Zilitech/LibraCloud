<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Book;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // Show form
    public function add()
    {
        $books = Book::all();
        return view('add_inventory', compact('books'));
    }

    public function index()
{
    // Get all inventories with related book details
    $inventories = \App\Models\Inventory::with('book')->get();
    return view('inventory_management', compact('inventories'));
}


    // Store inventory entry and update book stock
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_name' => 'required|string|max:255',
            'added_quantity' => 'required|integer|min:0',
            'damaged' => 'nullable|integer|min:0',
            'rack_number' => 'nullable|string|max:255',
            'condition' => 'nullable|string|max:255',
            'supplier' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        // Find the book record
        $book = Book::where('book_title', $request->book_name)->first();

        if (!$book) {
            return back()->with('error', 'Book not found!');
        }

        // Calculate new stock using book.quantity (not inventories table)
        $currentStock = $book->quantity ?? 0;
        $added = $request->added_quantity;
        $damaged = $request->damaged ?? 0;
        $newStock = $currentStock + $added - $damaged;

        // Update book stock
        $book->update(['quantity' => $newStock]);

        // Record the inventory transaction
        Inventory::create([
            'book_name' => $request->book_name,
            'current_stock' => $newStock,
            'added_quantity' => $added,
            'damaged' => $damaged,
            'rack_number' => $request->rack_number,
            'condition' => $request->condition,
            'supplier' => $request->supplier,
            'purchase_date' => $request->purchase_date,
            'remarks' => $request->remarks,
        ]);

        return redirect()->back()->with('success', '✅ Inventory record saved and book quantity updated!');
    }

    // AJAX - Get current stock from books table
    public function getBookStock($name)
    {
        $book = Book::where('book_title', $name)->first();
        return response()->json(['current_stock' => $book->quantity ?? 0]);
    }
}
