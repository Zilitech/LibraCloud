<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthorController extends Controller
{
    // Display all authors
    public function index()
    {
        $authors = DB::table('authors')->orderBy('id', 'desc')->get();
        return view('authors', compact('authors'));
    }

    // Store new author
    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
        ]);

        DB::table('authors')->insert([
            'author_name' => $request->author_name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Author added successfully!');
    }

    // Update author
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'author_name' => 'required|string|max:255',
        ]);

        DB::table('authors')
            ->where('id', $request->id)
            ->update([
                'author_name' => $request->author_name,
                'updated_at' => now(),
            ]);

        return redirect()->back()->with('success', 'Author updated successfully!');
    }

    // Delete author
    public function destroy($id)
    {
        DB::table('authors')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Author deleted successfully!');
    }

    // Import authors from CSV
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

        // Skip header if exists
        $header = fgetcsv($file);
        $imported = 0;

        while (($data = fgetcsv($file)) !== false) {
            $name = trim($data[0]);

            if (!empty($name)) {
                DB::table('authors')->insert([
                    'author_name' => $name,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $imported++;
            }
        }

        fclose($file);

        return redirect()->back()->with('success', "$imported authors imported successfully!");
    }
}
