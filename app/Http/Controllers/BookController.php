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
            'code' => 'nullable|string|max:100',
            'isbn' => 'nullable|string|max:100',
            'author_id' => 'nullable|exists:authors,id',
            'publisher' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'subject' => 'nullable|string|max:255',
            'rack_no' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:1',
            'price' => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'condition' => 'nullable|string|max:20',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ebook_file' => 'nullable|mimes:pdf|max:10240',
            'description' => 'nullable|string',
        ]);

        try {
            $data = $request->except(['cover_image', 'ebook_file']);

            // Handle cover image upload
            if ($request->hasFile('cover_image')) {
                $imageName = time() . '_cover.' . $request->cover_image->extension();
                $request->cover_image->move(public_path('uploads/books/covers'), $imageName);
                $data['cover_image'] = 'uploads/books/covers/' . $imageName;
            }

            // Handle ebook upload
            if ($request->hasFile('ebook_file')) {
                $fileName = time() . '_ebook.' . $request->ebook_file->extension();
                $request->ebook_file->move(public_path('uploads/books/ebooks'), $fileName);
                $data['ebook_file'] = 'uploads/books/ebooks/' . $fileName;
            }

            Book::create($data);

            return redirect()->route('books.all')->with('success', 'Book added successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add book. ' . $e->getMessage());
        }
    }

    /**
     * Display all books.
     */
    public function allBooks()
    {
        $books = Book::orderBy('created_at', 'desc')->get();
        $authors = Author::all();
        $categories = Category::all();
        return view('all_books', compact('books', 'authors', 'categories'));
    }

    /**
     * Show edit form.
     */
    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('edit_book', compact('book', 'categories', 'authors'));
    }

    /**
     * Update existing book.
     */
public function update(Request $request, $id)
{
    $request->validate([
        'book_title' => 'required|string|max:255',
        'code' => 'nullable|string|max:100',
        'isbn' => 'nullable|string|max:100',
        'author_id' => 'nullable|exists:authors,id',
        'publisher' => 'nullable|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'subject' => 'nullable|string|max:255',
        'rack_no' => 'nullable|string|max:100',
        'quantity' => 'required|integer|min:1',
        'price' => 'nullable|numeric',
        'purchase_date' => 'nullable|date',
        'condition' => 'nullable|string|max:20',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'ebook_file' => 'nullable|mimes:pdf|max:10240',
        'description' => 'nullable|string',
    ]);

    try {
        $book = Book::findOrFail($id);

        $data = $request->except(['cover_image', 'ebook_file']);

        if ($request->hasFile('cover_image')) {
            $imageName = time() . '_cover.' . $request->cover_image->extension();
            $request->cover_image->move(public_path('uploads/books/covers'), $imageName);
            $data['cover_image'] = 'uploads/books/covers/' . $imageName;
        }

        if ($request->hasFile('ebook_file')) {
            $fileName = time() . '_ebook.' . $request->ebook_file->extension();
            $request->ebook_file->move(public_path('uploads/books/ebooks'), $fileName);
            $data['ebook_file'] = 'uploads/books/ebooks/' . $fileName;
        }

        $book->update($data);

        return redirect()->route('books.all')->with('success', 'Book updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to update book. ' . $e->getMessage());
    }
}


    /**
     * Delete a book.
     */
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return redirect()->route('books.all')->with('success', 'Book deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete book. ' . $e->getMessage());
        }
    }

    /**
     * Show single book details.
     */
    public function show(Book $book)
    {
        return view('view_book', compact('book'));
    }
}
