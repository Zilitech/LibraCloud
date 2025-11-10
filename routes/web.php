<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


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

Route::get('/all_books', function(){
    return view('all_books');
});

Route::get('/add_book', function(){
    return view('add_book');
});

Route::get('/category', function(){
    return view('category');
});

Route::get('/authors', function(){
    return view('authors');
});

Route::get('/inventory_management', function(){
    return view('inventory_management');
});

Route::get('/add_inventory', function(){
    return view('add_inventory');
});

Route::get('/all_member', function(){
    return view('all_member');
});

Route::get('/add_member', function(){
    return view('add_member');
});

Route::get('/member_category', function(){
    return view('member_category');
});


Route::get('/membership_card', function(){
    return view('membership_card');
});

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
