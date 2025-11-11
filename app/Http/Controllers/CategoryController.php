<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Show all categories
    public function index()
    {
        $categories = DB::table('categories')->orderBy('id', 'desc')->get();
        return view('category', compact('categories'));
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        DB::table('categories')->insert([
            'category_name' => $request->category_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }

    // Update existing category
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'category_name' => 'required|string|max:255',
        ]);

        DB::table('categories')
            ->where('id', $request->id)
            ->update([
                'category_name' => $request->category_name,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
}
