<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // Show add inventory form
    public function add()
    {
        return view('add_inventory'); // no need to fetch books as it's now text input
    }

    // Inventory list page
    public function index(Request $request)
    {
        $filter = $request->filter ?? 'all';

        // Load inventory
        $query = Inventory::query();

        // Available stock
        if ($filter === 'available') {
            $query->where('current_stock', '>', 0);
        }

        // Low stock
        if ($filter === 'low') {
            $query->where('current_stock', '<', 5)
                  ->where('current_stock', '>', 0);
        }

        // Out of stock
        if ($filter === 'out') {
            $query->where('current_stock', '=', 0);
        }

        $inventories = $query->get();

        return view('inventory_management', compact('inventories', 'filter'));
    }

    // Store / Update Inventory
    public function store(Request $request)
    {
        $validated = $request->validate([
            'Item'           => 'required|string|max:255', // updated from book_id
            'added_quantity' => 'required|integer|min:0',
            'damaged'        => 'nullable|integer|min:0',
            'rack_number'    => 'nullable|string|max:255',
            'condition'      => 'nullable|string|max:255',
            'supplier'       => 'nullable|string|max:255',
            'purchase_date'  => 'nullable|date',
            'remarks'        => 'nullable|string',
        ]);

        $itemName = $request->Item;

        // Get or create inventory for the item
        $inventory = Inventory::where('Item', $itemName)->first();

        $added   = $request->added_quantity;
        $damaged = $request->damaged ?? 0;

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

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action'  => 'Update Inventory',
                'details' => 'Item: '.$itemName.' | Added: '.$added.' | Damaged: '.$damaged.' | New Stock: '.$newStock,
                'status'  => 'success',
            ]);
        } else {
            // Create new inventory
            $inventory = Inventory::create([
                'Item'           => $itemName,
                'current_stock'  => $added - $damaged,
                'added_quantity' => $added,
                'damaged'        => $damaged,
                'rack_number'    => $request->rack_number,
                'condition'      => $request->condition,
                'supplier'       => $request->supplier,
                'purchase_date'  => $request->purchase_date,
                'remarks'        => $request->remarks,
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'action'  => 'Add Inventory',
                'details' => 'Item: '.$itemName.' | Added: '.$added.' | Damaged: '.$damaged.' | Stock: '.($added - $damaged),
                'status'  => 'success',
            ]);
        }

        return back()->with('success', 'Inventory saved & stock updated successfully!');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $itemName  = $inventory->Item;
        $inventory->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Inventory',
            'details' => 'Deleted inventory for item: '.$itemName,
            'status'  => 'success',
        ]);

        return redirect()->back()->with('success', 'Inventory deleted successfully.');
    }
}
