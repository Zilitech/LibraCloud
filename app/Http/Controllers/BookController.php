<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Show add book form.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('add_book', compact('categories', 'authors'));
    }

    /**
     * Store new book record.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_title' => 'required|string|max:255',
            'book_code' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:100',
            'author_id' => 'nullable|exists:authors,id',
            'publisher' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subject' => 'nullable|string|max:255',
            'rack_number' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'condition' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ebook_file' => 'nullable|mimes:pdf|max:10240',
            'description' => 'nullable|string',
        ]);

        $data = $request->except(['cover_image', 'ebook_file']);

        // Upload Cover Image
        if ($request->hasFile('cover_image')) {
            $imageName = time().'_cover.'.$request->cover_image->extension();
            $request->cover_image->move(public_path('uploads/books/covers'), $imageName);
            $data['cover_image'] = 'uploads/books/covers/'.$imageName;
        }

        // Upload E-Book
        if ($request->hasFile('ebook_file')) {
            $fileName = time().'_ebook.'.$request->ebook_file->extension();
            $request->ebook_file->move(public_path('uploads/books/ebooks'), $fileName);
            $data['ebook_file'] = 'uploads/books/ebooks/'.$fileName;
        }

        Book::create($data);

        return redirect()->back()->with('success', 'Book added successfully!');
    }
}
