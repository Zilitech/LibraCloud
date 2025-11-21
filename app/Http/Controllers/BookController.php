<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Models\IssuedBook;


class BookController extends Controller
{
    // Show form
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('add_book', compact('categories', 'authors'));
    }

    

    // Store book
    public function store(Request $request)
    {
        $request->validate([
            'book_title'   => 'required|string|max:255',
            'book_code'    => 'nullable|string|max:100',
            'isbn'         => 'nullable|string|max:100',
            'author_name'  => 'nullable|string|max:255',
            'category_name'=> 'required|string|max:255',
            'publisher'    => 'nullable|string|max:255',
            'subject'      => 'nullable|string|max:255',
            'rack_number'  => 'nullable|string|max:100',
            'quantity'     => 'required|integer|min:1',
            'price'        => 'nullable|numeric',
            'purchase_date'=> 'nullable|date',
            'condition'    => 'nullable|string|max:20',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ebook_file'   => 'nullable|mimes:pdf|max:10240',
            'description'  => 'nullable|string',
        ]);

        // Ensure category & author exist in their tables (optional but useful)
        if ($request->filled('category_name')) {
            Category::firstOrCreate(['category_name' => $request->category_name]);
        }

        if ($request->filled('author_name')) {
            Author::firstOrCreate(['author_name' => $request->author_name]);
        }

        $data = $request->only([
            'book_title','book_code','isbn','author_name','publisher','category_name',
            'subject','rack_number','quantity','price','purchase_date','condition','description'
        ]);

        // handle files
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

        Book::create($data);

        return redirect()->route('books.all')->with('success', 'Book added successfully!');
    }

    // Other methods (edit, update, allBooks, show, destroy) — keep same pattern
    public function allBooks()
    {
        $books = Book::orderBy('created_at','desc')->get();
        $categories = Category::all();
        $authors = Author::all();
        return view('all_books', compact('books','categories','authors'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.edit_book', compact('book','categories','authors'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_title'   => 'required|string|max:255',
            'book_code'    => 'nullable|string|max:100',
            'isbn'         => 'nullable|string|max:100',
            'author_name'  => 'nullable|string|max:255',
            'category_name'=> 'required|string|max:255',
            'publisher'    => 'nullable|string|max:255',
            'subject'      => 'nullable|string|max:255',
            'rack_number'  => 'nullable|string|max:100',
            'quantity'     => 'required|integer|min:1',
            'price'        => 'nullable|numeric',
            'purchase_date'=> 'nullable|date',
            'condition'    => 'nullable|string|max:20',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ebook_file'   => 'nullable|mimes:pdf|max:10240',
            'description'  => 'nullable|string',
        ]);

        if ($request->filled('category_name')) {
            Category::firstOrCreate(['category_name' => $request->category_name]);
        }

        if ($request->filled('author_name')) {
            Author::firstOrCreate(['author_name' => $request->author_name]);
        }

        $data = $request->only([
            'book_title','book_code','isbn','author_name','publisher','category_name',
            'subject','rack_number','quantity','price','purchase_date','condition','description'
        ]);

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
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.all')->with('success', 'Book deleted successfully!');
    }

    public function show(Book $book)
    {
        return view('books.view_book', compact('book'));
    }


    // Fetch book by scanned code
public function scanPage()
    {
        return view('scan_barcode'); // Blade file for scanning
    }

    // 2️⃣ Fetch book details by barcode
    public function getByBarcode($code)
    {
        $book = Book::where('book_code', $code)
                    ->orWhere('isbn', $code)
                    ->first();

        if (!$book) {
            return response()->json(['success' => false]);
        }

        return response()->json([
            'success' => true,
            'book' => [
                'title'        => $book->book_title,
                'author'       => $book->author_name,
                'category'     => $book->category_name,
                'publisher'    => $book->publisher,
                'subject'      => $book->subject,
                'rack_number'  => $book->rack_number,
                'total_copies' => $book->quantity,
                'available'    => $book->available ?? $book->quantity,
                'issued'       => $book->issued ?? 0,
                'price'        => $book->price,
                'code'         => $book->book_code,
                'isbn'         => $book->isbn,
                'cover'        => $book->cover_image ?? asset('images/media/default_book.png'),
                'ebook'        => $book->ebook_file ? asset($book->ebook_file) : null,
                'description'  => $book->description,
                'condition'    => $book->condition,
                'purchase_date'=> $book->purchase_date,
            ]
        ]);
    }


public function getIssuedBooksByISBN($isbn)
{
    $issuedBooks = IssuedBook::with('book')->where('book_isbn', $isbn)->get();

    if ($issuedBooks->isEmpty()) {
        return response()->json([
            'success' => false,
            'html' => '<tr><td colspan="5" class="text-center">No issued books found</td></tr>'
        ]);
    }

    $html = '';
    foreach ($issuedBooks as $issue) {
        $html .= '<tr>
            <td>' . $issue->book_isbn . '</td>
            <td>' . $issue->member_name . '</td>
            <td>' . $issue->issue_date->format('Y-m-d') . '</td>
            <td>' . $issue->due_date->format('Y-m-d') . '</td>
            <td><a href="/return-book/' . $issue->id . '" class="btn btn-sm btn-warning" onclick="return confirm(\'Return this book?\')">Return</a></td>
        </tr>';
    }

    return response()->json([
        'success' => true,
        'html' => $html
    ]);
}


}
