<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Book;

class InventoryController extends Controller
{
    // Show Add Inventory form
    public function add()
    {
        $books = Book::all(); // Fetch books for dropdown
        return view('add_inventory', compact('books'));
    }

    // Store inventory data
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'book_id' => 'required|exists:books,id',
            'added_quantity' => 'required|integer|min:0',
            'damaged' => 'nullable|integer|min:0',
            'rack_number' => 'nullable|string|max:255',
            'condition' => 'nullable|string|in:Good,Average,Damaged',
            'supplier' => 'nullable|string|max:255',
            'purchase_date' => 'nullable|date',
            'remarks' => 'nullable|string',
        ]);

        // Insert into database
        Inventory::create([
            'book_id' => $validated['book_id'],
            'added_quantity' => $validated['added_quantity'],
            'damaged' => $validated['damaged'] ?? 0,
            'rack_number' => $validated['rack_number'] ?? null,
            'condition' => $validated['condition'] ?? null,
            'supplier' => $validated['supplier'] ?? null,
            'purchase_date' => $validated['purchase_date'] ?? null,
            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Inventory added successfully.');
    }
}
