<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Homecontroller;
// Route::get('/', function () {return view('home'); });

Route::get('/', [Homecontroller::class, 'tampilgambar']);


Route::resource('products', ProductController::class);

Route::view('/about', 'About');
Route::view('/login', 'Login');

Route::get('/ajax-search', [ProductController::class, 'ajaxSearch']);
