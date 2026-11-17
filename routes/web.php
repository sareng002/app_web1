<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
// Route::get('/', function () {return view('home'); });

route:: view('/','home');

Route::get('/produk', [ProductController::class, 'index']);
Route::view('/about', 'About');
Route::view('/login', 'Login');

Route::get('/ajax-search', [ProductController::class, 'ajaxSearch']);
