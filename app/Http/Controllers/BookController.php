<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Author;
use App\Models\Member;
use Illuminate\Http\Request;
use App\Models\IssuedBook;
use App\Helpers\ActivityLogger;
use App\Models\AutoNumber;
use Illuminate\Support\Facades\Mail;
use App\Helpers\MailHelper;
use App\Models\NotificationTemplate;

class BookController extends Controller
{
    // Show form
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('add_book', compact('categories', 'authors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'book_title'    => 'required|string|max:255',
        'book_code'     => 'nullable|string|max:100',
        'isbn'          => 'nullable|string|max:100',
        'author_name'   => 'nullable|string|max:255',
        'category_name' => 'required|string|max:255',
        'publisher'     => 'nullable|string|max:255',
        'subject'       => 'nullable|string|max:255',
        'rack_number'   => 'nullable|string|max:100',
        'quantity'      => 'required|integer|min:1',
        'price'         => 'nullable|numeric',
        'purchase_date' => 'nullable|date',
        'condition'     => 'nullable|string|max:20',
        'cover_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'ebook_file'    => 'nullable|mimes:pdf|max:10240',
        'description'   => 'nullable|string',
        'auto_generate' => 'nullable|string|in:enable,disable',
    ]);

    // Ensure category & author exist
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

    // Auto-generate book_code
    if ($request->auto_generate === 'enable' || empty($data['book_code'])) {
        $autoBook = AutoNumber::where('type', 'book_code')->first();
        if ($autoBook) {
            $autoBook->last_number += 1;
            $autoBook->save();
            $data['book_code'] = $autoBook->prefix . str_pad($autoBook->last_number, $autoBook->digits, '0', STR_PAD_LEFT);
        } else {
            $data['book_code'] = 'BK' . date('YmdHis'); 
        }
    }

    // Handle file uploads
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

    // SAVE NEW BOOK
    $book = Book::create($data);

    // LOG ACTIVITY
    ActivityLogger::log(
        'Add Book',
        "Added Book: {$book->book_title} (Code: {$book->book_code})",
        'success'
    );

    // -------------------------------------------------------------------
    //  NEW ARRIVAL EMAIL SEND TO ALL MEMBERS
    // -------------------------------------------------------------------

    try {
        MailHelper::applyEmailSettings(); // Load SMTP

        $template = NotificationTemplate::where('event_name', 'New Arrival')->first();

        if ($template) {

            $members = Member::whereNotNull('email')->get(); // all users with email

            foreach ($members as $m) {

                $messageBody = $template->message;

                // TEMPLATE VARIABLES
                $messageBody = str_replace('{{member_name}}', $m->fullname, $messageBody);
                $messageBody = str_replace('{{book_title}}', $book->book_title, $messageBody);
                $messageBody = str_replace('{{book_no}}', $book->isbn, $messageBody);
                $messageBody = str_replace('{{book_author}}', $book->author_name, $messageBody);
                $messageBody = str_replace('{{today_date}}', date('Y-m-d'), $messageBody);

                try {
                    Mail::html(nl2br($messageBody), function ($msg) use ($m) {
                        $msg->to($m->email)
                            ->subject('New Arrival – Library Update');
                    });
                } catch (\Exception $e) {
                    \Log::error("New Arrival Email Failed for {$m->email}: " . $e->getMessage());
                }
            }
        }

    } catch (\Exception $e) {
        \Log::error("SMTP or Template Error: " . $e->getMessage());
    }

    return redirect()->route('books.all')
        ->with('success', 'Book added successfully! New Arrival email sent to all members.');
}


    // List all books
    public function allBooks()
    {
        $books = Book::orderBy('created_at','desc')->get();
        $categories = Category::all();
        $authors = Author::all();
        return view('all_books', compact('books','categories','authors'));
    }

    // Edit book
    public function edit(Book $book)
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.edit_book', compact('book','categories','authors'));
    }

    // Update book
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'book_title'    => 'required|string|max:255',
            'book_code'     => 'nullable|string|max:100',
            'isbn'          => 'nullable|string|max:100',
            'author_name'   => 'nullable|string|max:255',
            'category_name' => 'required|string|max:255',
            'publisher'     => 'nullable|string|max:255',
            'subject'       => 'nullable|string|max:255',
            'rack_number'   => 'nullable|string|max:100',
            'quantity'      => 'required|integer|min:1',
            'price'         => 'nullable|numeric',
            'purchase_date' => 'nullable|date',
            'condition'     => 'nullable|string|max:20',
            'cover_image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'ebook_file'    => 'nullable|mimes:pdf|max:10240',
            'description'   => 'nullable|string',
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

        // Detect changed fields for logging
        $changes = [];
        foreach ($data as $key => $newValue) {
            $oldValue = $book->$key;
            if ($newValue != $oldValue) {
                $changes[] = strtoupper($key) . ": {$oldValue} → {$newValue}";
            }
        }

        $book->update($data);

        // Log activity
        $details = count($changes) > 0
            ? "Updated Book - {$book->book_title}. Changes: " . implode(', ', $changes)
            : "Book '{$book->book_title}' updated (no changes detected)";

        ActivityLogger::log('Edit Book', $details, 'success');

        return redirect()->route('books.all')->with('success', 'Book updated successfully!');
    }

    // Delete book
    public function destroy(Book $book)
    {
        $book->delete();

        ActivityLogger::log('Delete Book', "Deleted Book: {$book->book_title} (Code: {$book->book_code})", 'success');

        return redirect()->route('books.all')->with('success', 'Book deleted successfully!');
    }

    // View single book
    public function show(Book $book)
    {
        return view('books.view_book', compact('book'));
    }

    // Scan book page
    public function scanPage()
    {
        return view('scan_barcode');
    }

    // Get book by barcode or ISBN
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

    // Get issued books by ISBN
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

    // Library report
    public function library_report()
    {
        $libraryBooks = Book::with('issuedBooks', 'inventory')->get()->map(function($book) {
            $book->issued = $book->issuedBooks->count();
            $book->available = $book->quantity - $book->issued;
            $book->damaged = $book->inventory?->damaged ?? 0;
            return $book;
        });

        return view('library_report', compact('libraryBooks'));
    }





    
    public function import(Request $request)
{
    $request->validate([
        'import_file' => 'required|file|mimes:csv,txt|max:4096',
    ]);

    $file = fopen($request->file('import_file')->getRealPath(), 'r');

    // Skip header
    $header = fgetcsv($file);
    $imported = 0;

    while (($row = fgetcsv($file)) !== false) {

        $title         = trim($row[0] ?? '');
        $book_code     = trim($row[1] ?? '');
        $isbn          = trim($row[2] ?? '');
        $author        = trim($row[3] ?? '');
        $category      = trim($row[4] ?? '');
        $publisher     = trim($row[5] ?? '');
        $subject       = trim($row[6] ?? '');
        $rack_number   = trim($row[7] ?? '');
        $quantity      = intval($row[8] ?? 0);
        $price         = floatval($row[9] ?? 0);
        $purchase_date = trim($row[10] ?? '');
        $condition     = trim($row[11] ?? '');
        $cover_image   = trim($row[12] ?? '');
        $ebook_file    = trim($row[13] ?? '');
        $description   = trim($row[14] ?? '');

        if (empty($title)) continue;

        // Auto-generate book code
        if (empty($book_code)) {
            $autoBook = AutoNumber::where('type', 'book_code')->first();

            if ($autoBook) {
                $autoBook->last_number++;
                $autoBook->save();

                $book_code = $autoBook->prefix .
                             str_pad($autoBook->last_number, $autoBook->digits, '0', STR_PAD_LEFT);
            } else {
                $book_code = 'BK' . date('YmdHis');
            }
        }

        // Fix invalid dates
        $purchase_date = ($purchase_date && strtotime($purchase_date))
            ? date('Y-m-d', strtotime($purchase_date))
            : null;

        Book::create([
            'book_title'    => $title,
            'book_code'     => $book_code,
            'isbn'          => $isbn,
            'author_name'   => $author,
            'category_name' => $category,
            'publisher'     => $publisher,
            'subject'       => $subject,
            'rack_number'   => $rack_number,
            'quantity'      => $quantity,
            'price'         => $price,
            'purchase_date' => $purchase_date,
            'condition'     => $condition,
            'cover_image'   => $cover_image,
            'ebook_file'    => $ebook_file,
            'description'   => $description,
        ]);

        $imported++;
    }

    fclose($file);

    ActivityLogger::log('Import Books', "Imported $imported books from CSV");

    return redirect()->back()->with('success', "$imported books imported successfully!");
}

public function downloadSample()
{
    $filePath = public_path('sample/add_book_sample_import_file.csv');

    return response()->download($filePath, 'Sample-Book-Import.csv', [
        'Content-Type' => 'text/csv',
    ]);
}


}
