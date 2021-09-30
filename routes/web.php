<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', 'SuperController@index');

Route::post('/makeCookie', 'SuperController@makeCookie');

Route::get('/dashboard', 'SuperController@dashboard')->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

Route::resource('Product', 'ProductController');

Route::resource('Category', 'CategoryController');

Route::resource('Blog', 'BlogController');
