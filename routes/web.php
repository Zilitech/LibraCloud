<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GeneralsettingController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\MembercardController;



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


Route::get('/add_book', [BookController::class, 'create'])->name('books.create');
Route::post('/add_book', [BookController::class, 'store'])->name('books.store');

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




Route::get('/issue_book', function(){
    return view('issue_book');
});

Route::get('/issue', function(){
    return view('issue');
});

Route::get('/returned_books', function(){
    return view('returned_books');
});

Route::get('/overdue', function(){
    return view('overdue');
}); 

Route::get('/fine_management', function(){
    return view('fine_management');
});

Route::get('/fine_setting', function(){
    return view('fine_setting');
});

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

Route::get('/e-book', function(){
    return view('e-book');
});

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

Route::get('/admin_librarien', function(){
    return view('admin_librarien');
});

Route::get('/roles_permission', function(){
    return view('roles_permission');
});

Route::get('/activity_log', function(){
    return view('activity_log');
});

Route::get('/system_backup', function(){
    return view('system_backup');
});

Route::get('/library_report', function(){
    return view('library_report');
});

Route::get('/scan_barcode', function(){
    return view('scan_barcode');
});

Route::get('/generate_barcode', function(){
    return view('generate_barcode');
});

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
