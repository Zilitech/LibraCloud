<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ebook;
use App\Models\Author;
use App\Models\Category;

class EbookController extends Controller
{
    // Show upload form
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('ebooks.create', compact('authors', 'categories'));
    }

    // Store eBook
    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required|string|max:255',
            'author_name' => 'required|string|max:255',
            'category_name' => 'required|string|max:255',
            'file_path' => 'required|mimes:pdf|max:10240',
            'total_pages' => 'nullable|integer',
            'price' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $filePath = null;
        if ($request->hasFile('file_path')) {
            $filePath = $request->file('file_path')->store('pdfs', 'public');
        }

        Ebook::create([
            'book_title' => $request->book_title,
            'author_name' => $request->author_name,
            'category_name' => $request->category_name,
            'file_path' => $filePath,
            'total_pages' => $request->total_pages,
            'price' => $request->price,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'E-Book uploaded successfully!');
    }

    // List eBooks
    public function index()
    {
        $authors = Author::all();
        $categories = Category::all();
        $ebooks = Ebook::all();
        return view('e-book', compact('authors', 'categories', 'ebooks'));
    }

    public function download($id)
{
    $ebook = Ebook::findOrFail($id);

    $file = storage_path('app/public/' . $ebook->file_path);

    if (!file_exists($file)) {
        return back()->with('error', 'File not found!');
    }

    return response()->download($file);
}


public function destroy($id)
{
    $ebook = Ebook::findOrFail($id);

    // delete file also
    if ($ebook->file_path && file_exists(storage_path('app/public/' . $ebook->file_path))) {
        unlink(storage_path('app/public/' . $ebook->file_path));
    }

    $ebook->delete();

    return redirect()->back()->with('success', 'E-Book deleted successfully!');
}



}
