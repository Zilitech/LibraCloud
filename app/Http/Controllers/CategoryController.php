<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

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

        $id = DB::table('categories')->insertGetId([
            'category_name' => $request->category_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Activity log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Add Category',
            'details' => 'Added category: ' . $request->category_name,
            'status'  => 'success',
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

        // Activity log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Update Category',
            'details' => 'Updated category ID ' . $request->id . ' to ' . $request->category_name,
            'status'  => 'success',
        ]);

        return redirect()->back()->with('success', 'Category updated successfully!');
    }

    // Delete category
    public function destroy($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        DB::table('categories')->where('id', $id)->delete();

        // Activity log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Delete Category',
            'details' => 'Deleted category: ' . ($category->category_name ?? 'N/A') . ' (ID: ' . $id . ')',
            'status'  => 'success',
        ]);

        return redirect()->back()->with('success', 'Category deleted successfully!');
    }

    // Import categories from CSV
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');
        $header = fgetcsv($file); // Skip header row if present
        $imported = 0;

        while (($data = fgetcsv($file)) !== false) {
            if (!empty($data[0])) {
                DB::table('categories')->insert([
                    'category_name' => $data[0],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $imported++;
            }
        }

        fclose($file);

        // Activity log
        ActivityLog::create([
            'user_id' => Auth::id(),
            'action'  => 'Import Categories',
            'details' => "Imported $imported categories from CSV file",
            'status'  => 'success',
        ]);

        return redirect()->back()->with('success', 'Categories imported successfully!');
    }
}
