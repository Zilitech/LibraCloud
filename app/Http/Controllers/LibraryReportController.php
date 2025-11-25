<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use App\Models\IssuedBook;
use App\Models\ReturnedBook;
use App\Models\Ebook;
use App\Models\Staff;
use App\Models\ActivityLog;

class LibraryReportController extends Controller
{
    public function index()
    {
        // Fetch all books
        $libraryBooks = Book::all();

        // Fetch all members
        $members = Member::all();

        // Fetch all Issued Books
        $issued_books = IssuedBook::all();

        // Fetch all Returned Books
        $returned_books = ReturnedBook::all();

        // Fetch all E-Books 
        $ebooks = Ebook::all();

        // Fetch all Staff
        $all_staff = Staff::all();

        // Fetch all activity logs
        $activity_logs = ActivityLog::all();

        // Pass data to the view
        return view('library_report', compact('libraryBooks', 'members', 'issued_books', 'returned_books', 'ebooks', 'all_staff','activity_logs'));
    }
}
