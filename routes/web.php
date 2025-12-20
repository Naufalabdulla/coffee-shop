<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', App\Http\Controllers\ProductController::class);
Route::resource('transactions', TransactionController::class)->middleware('auth');
