<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GeneralsettingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MembercardController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\IssueBookController;
use App\Http\Controllers\ReturnedBookController;
use App\Http\Controllers\FineSettingController;
use App\Http\Controllers\OverdueBookController;
use App\Http\Controllers\FineController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ScanBarcodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\BackupController;
use App\Http\Controllers\LibraryReportController;






// ✅ Show login page by default
Route::get('/', function () {
    // If already logged in → redirect to dashboard
    if (session()->has('admin_id')) {
        return redirect()->route('admin.dashboard');
    }
    return view('adminLogin'); // your login page
})->name('admin.login.form');

// ✅ Handle login form submission
Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');

// ✅ Dashboard page (only accessible if logged in)
Route::get('/dashboard', [AdminLoginController::class, 'dashboard'])->name('admin.dashboard');

// ✅ Logout route
Route::get('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');


Route::get('/nav_sidebar', function(){
    return view('nav_sidebar');
});

Route::get('/header', function(){
    return view('header');
});

Route::get('/heading_cards', function(){
    return view('heading_cards');
});

Route::get('/body', function(){
    return view('body');
});

Route::get('/footer', function(){
    return view('footer');
});

Route::get('/foot', function(){
    return view('foot');
});

Route::get('/head', function(){
    return view('head');
});

Route::get('/switcher', function(){
    return view('switcher');
});

Route::get('/all_books', [BookController::class, 'allBooks'])->name('books.all');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
// web.php
Route::get('/issued-books/isbn/{isbn}', [BookController::class, 'getIssuedBooksByISBN']);




Route::get('/books', [BookController::class, 'index'])->middleware('permission:manage_books');



Route::get('/library/report', [LibraryReportController::class, 'index'])->name('library.report');






Route::get('/add_book', [BookController::class, 'create'])->name('books.create');
Route::post('/add_book', [BookController::class, 'store'])->name('books.store');

Route::get('/books', [BookController::class, 'index'])->middleware('permission:manage_books');


Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::post('/category/update', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::post('/category/import', [CategoryController::class, 'import'])->name('category.import');







Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
Route::post('/authors', [AuthorController::class, 'store'])->name('author.store');
Route::post('/authors/update', [AuthorController::class, 'update'])->name('author.update');
Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('author.destroy');
Route::post('/authors/import', [AuthorController::class, 'import'])->name('author.import');




Route::get('/inventory_management', [InventoryController::class, 'index']);


// Show add inventory form
Route::get('/add_inventory', [InventoryController::class, 'add'])->name('inventory.add');
Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');
Route::get('/books/{name}/stock', [InventoryController::class, 'getBookStock']);
Route::delete('/inventory/{id}', [InventoryController::class, 'destroy']);
Route::get('/inventory_management', [InventoryController::class, 'index'])->name('inventory.index');






Route::get('/membership_card', [App\Http\Controllers\MembercardController::class, 'index'])->name('membership.card');
Route::post('/generate-id-card', [App\Http\Controllers\MembercardController::class, 'generateIdCardPDF'])->name('generate.idcard');






Route::get('/add_member', [App\Http\Controllers\MemberController::class, 'create'])->name('member.create');
Route::post('/add_member', [App\Http\Controllers\MemberController::class, 'store'])->name('member.store');
Route::post('/member/import', [App\Http\Controllers\MemberController::class, 'import'])->name('member.import');
Route::get('/all_member', [App\Http\Controllers\MemberController::class, 'show'])->name('member.show');
Route::get('/members/{member}/edit', [App\Http\Controllers\MemberController::class, 'edit'])->name('members.edit');
Route::put('/members/{member}', [App\Http\Controllers\MemberController::class, 'update'])->name('members.update');
Route::get('/members', [App\Http\Controllers\MemberController::class, 'index'])->name('members.index');
Route::delete('/members/{member}', [App\Http\Controllers\MemberController::class, 'destroy'])->name('members.destroy');  

Route::get('/member_category', [App\Http\Controllers\MembercategoryController::class, 'index'])->name('membercategory.index');
Route::post('/member_category', [App\Http\Controllers\MembercategoryController::class, 'store'])->name('membercategory.store');
Route::post('/member_category/update', [App\Http\Controllers\MembercategoryController::class, 'update'])->name('membercategory.update');
Route::delete('/member_category/{id}', [App\Http\Controllers\MembercategoryController::class, 'destroy'])->name('membercategory.destroy');
Route::post('/member_category/import', [App\Http\Controllers\MembercategoryController::class, 'import'])->name('membercategory.import');





// Show the Issue Book form
Route::get('/issue', [IssueBookController::class, 'create'])->name('issue-book.create');

// Submit the Issue Book form
Route::post('/issue', [IssueBookController::class, 'store'])->name('issue-book.store');
Route::get('/issue_book', [IssueBookController::class, 'index'])->name('issue-book.index');
Route::delete('/issue-book/{id}', [IssueBookController::class, 'destroy'])->name('issue-book.destroy');
Route::get('/issue-book/return/{id}', [IssueBookController::class, 'returnBook'])->name('issue-book.return');



Route::get('/returned_books', [ReturnedBookController::class, 'index'])->name('returned-book.index');
Route::get('/returned-books/delete/{id}', [ReturnedBookController::class, 'destroy'])->name('returned-book.delete');
Route::get('/returned-books/reissue/{id}', [ReturnedBookController::class, 'reissue'])->name('returned-book.reissue');
Route::post('/return-book', [ReturnBookController::class, 'returnBook'])
    ->name('return.book');









 Route::get('/overdue', [OverdueBookController::class, 'index'])->name('overdue_books.index');

    // Optional: manually trigger update (if needed)
Route::get('/overdue/update', [OverdueBookController::class, 'updateOverdueBooks'])->name('overdue_books.update');
Route::post('/books/return/{issue_id}', [OverdueBookController::class, 'markAsReturned'])->name('books.return');
Route::post('/books/return/{issue_id}', [OverdueBookController::class, 'markAsReturned'])->name('books.return');



Route::prefix('fines')->group(function () {
    // Show Fine Management page
    Route::get('/', [FineController::class, 'index'])->name('fines.index');

    // Mark fine as paid
    Route::post('{id}/mark-paid', [FineController::class, 'markAsPaid'])->name('fines.markAsPaid');

    // Delete fine
    Route::delete('{id}', [FineController::class, 'destroy'])->name('fines.destroy');

    // Optional: Print receipt route (if you later implement this method in controller)
    // Route::get('{id}/print', [FineController::class, 'printReceipt'])->name('fines.printReceipt');
}); // optional


Route::get('/fine-settings', [FineSettingController::class, 'index'])->name('fine.settings');
Route::post('/fine-settings', [FineSettingController::class, 'store'])->name('fine.settings.store');

Route::get('/due_date_alert', function(){
    return view('due_date_alert');
});

Route::get('/due_date_setting', function(){
    return view('due_date_setting');
});

Route::get('/new_arrival_alert', function(){
    return view('new_arrival_alert');
});

Route::get('/new_arrival_setting', function(){
    return view('new_arrival_setting');
});

Route::get('/e-book', [EbookController::class, 'index'])->name('ebooks.index');
Route::post('/e-book/store', [EbookController::class, 'store'])->name('ebooks.store');
Route::get('/ebook/download/{id}', [EbookController::class, 'download'])->name('ebooks.download');
Route::delete('/e-book/delete/{id}', [EbookController::class, 'destroy'])->name('ebooks.destroy');
Route::get('/e-book_reader/{id}', [EbookController::class, 'read'])->name('ebook.read');



Route::get('/e-book_reader', function(){
    return view('e-book_reader');
});

Route::get('/general-settings', [GeneralsettingController::class, 'index'])->name('general.settings');
Route::post('/general-settings/update', [GeneralsettingController::class, 'update'])->name('general.settings.update');

Route::get('/library_setting', function(){
    return view('library_setting');
});

Route::get('/fine_setting', function(){
    return view('fine_setting');
});

Route::get('/issue_return_rules', function(){
    return view('issue_return_rules');
});

// Route::get('/admin_librarien', function(){
//     return view('admin_librarien');
// });

Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
Route::get('/staff/edit/{id}', [StaffController::class, 'edit'])->name('staff.edit');
Route::put('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.update'); // allow PUT
Route::delete('/staff/delete/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');




Route::get('/activity_log', [ActivityLogController::class, 'index'])->name('activity.logs');
Route::get('activity-logs/fetch', [ActivityLogController::class, 'fetchLogs'])
    ->name('activity.logs.fetch');

Route::get('/activity_log', [ActivityLogController::class, 'index'])->name('activity_logs.index');




Route::prefix('system_backup')->group(function () {
    Route::get('/', [BackupController::class, 'index'])->name('system.backup.index');
    Route::post('/run', [BackupController::class, 'runBackup'])->name('system.backup.run');
    Route::get('/download/{id}', [BackupController::class, 'download'])->name('system.backup.download');
    Route::delete('/delete/{id}', [BackupController::class, 'destroy'])->name('system.backup.delete');
});




Route::get('/scan_barcode', function(){
    return view('scan_barcode');
});

Route::post('/get-issued-books', [ScanBarcodeController::class, 'getIssuedBooks'])->name('get.issued.books');
Route::get('/scan_barcode', [ScanBarcodeController::class, 'index']);
Route::post('/return-book', [ScanBarcodeController::class, 'returnBook']);











Route::get('/barcode/book', [BarcodeController::class, 'index'])->name('barcode.book');
Route::get('/barcode/book/data', [BarcodeController::class, 'bookData'])->name('barcode.book.data');
Route::get('/scan_barcode', [BookController::class, 'scanPage'])->name('barcode.scan');
Route::get('/books/barcode/{code}', [BookController::class, 'getByBarcode'])->name('books.barcode');
Route::get('/barcode/book/data/{code}', [BarcodeController::class, 'getByBarcode']);


Route::get('/lookup_by_barcode', function(){
    return view('lookup_by_barcode');
});

Route::get('/user_manual', function(){
    return view('user_manual');
});

Route::get('/developer_info', function(){
    return view('developer_info');
});

Route::get('/version_info', function(){
    return view('version_info');
});

Route::get('/profile', function(){
    return view('profile');
});

Route::get('/edit_profile', function(){
    return view('edit_profile');
});

Route::get('/mail', function(){
    return view('mail');
});

Route::get('/chat', function(){
    return view('chat');
});

Route::get('/adminLogin', function(){
    return view('adminLogin');
});

Route::get('/database_connection', function(){
    return view('database_connection');
});


Route::get('/roles_permission', [RoleController::class, 'index'])->name('roles_permission.index');
Route::post('/roles/store', [RoleController::class, 'store'])->name('roles.store');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

// Optional: Edit Role
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
