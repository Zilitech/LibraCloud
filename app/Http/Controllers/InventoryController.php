<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Book;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    // Show add inventory form
    public function add()
    {
        $books = Book::all();
        return view('add_inventory', compact('books'));
    }

    // Inventory list page
public function index(Request $request)
{
    $filter = $request->filter ?? 'all';

    // Load inventory with book + related author and category
    $query = Inventory::with(['book.author', 'book.category']);

    // Available stock (stock > 0)
    if ($filter === 'available') {
        $query->where('current_stock', '>', 0);
    }

    // Low stock (example threshold: < 5 but > 0)
    if ($filter === 'low') {
        $query->where('current_stock', '<', 5)
              ->where('current_stock', '>', 0);
    }

    // Out of stock (stock = 0)
    if ($filter === 'out') {
        $query->where('current_stock', '=', 0);
    }

    // Fetch the filtered data
    $inventories = $query->get();

    return view('inventory_management', compact('inventories', 'filter'));
}



    // Store / Update Inventory
    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_id'        => 'required|exists:books,id',
            'added_quantity' => 'required|integer|min:0',
            'damaged'        => 'nullable|integer|min:0',
            'rack_number'    => 'nullable|string|max:255',
            'condition'      => 'nullable|string|max:255',
            'supplier'       => 'nullable|string|max:255',
            'purchase_date'  => 'nullable|date',
            'remarks'        => 'nullable|string',
        ]);

        $book = Book::find($request->book_id);

        // Get or create inventory for the book
        $inventory = Inventory::where('book_id', $request->book_id)->first();

        $added    = $request->added_quantity;
        $damaged  = $request->damaged ?? 0;

        if ($inventory) {
            // Update existing inventory
            $newStock = $inventory->current_stock + $added - $damaged;

            $inventory->update([
                'current_stock'   => $newStock,
                'added_quantity'  => $inventory->added_quantity + $added,
                'damaged'         => $inventory->damaged + $damaged,
                'rack_number'     => $request->rack_number,
                'condition'       => $request->condition,
                'supplier'        => $request->supplier,
                'purchase_date'   => $request->purchase_date,
                'remarks'         => $request->remarks,
            ]);
        } else {
            // Create new inventory
            $inventory = Inventory::create([
                'book_id'        => $request->book_id,
                'current_stock'  => $added - $damaged,
                'added_quantity' => $added,
                'damaged'        => $damaged,
                'rack_number'    => $request->rack_number,
                'condition'      => $request->condition,
                'supplier'       => $request->supplier,
                'purchase_date'  => $request->purchase_date,
                'remarks'        => $request->remarks,
            ]);
        }

        // Update book stock column also (optional)
        $book->update(['quantity' => $inventory->current_stock]);

        return back()->with('success', 'Inventory saved & stock updated successfully!');
    }

    public function destroy($id)
{
    Inventory::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Inventory deleted successfully.');
}



}
