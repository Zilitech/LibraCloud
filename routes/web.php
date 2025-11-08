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