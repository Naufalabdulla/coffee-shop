<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

// Route::get('/login', function () {
//     return 'Login page (dummy)';
// })->name('login');


Route::get('/', function () {
    return view('welcome');
});


// ORDER & CART (TANPA AUTH)
Route::get('/order', [OrderController::class, 'index'])->name('order');
Route::get('/menu', function() {
    return redirect('/order');
});

Route::get('/add-to-cart/{id}', [OrderController::class, 'addToCart']);

Route::post('/cart-increase/{id}', [OrderController::class, 'increase']);
Route::post('/cart-decrease/{id}', [OrderController::class, 'decrease']);

Route::post('/pay', [OrderController::class, 'pay']);

Route::get('/transactions', [OrderController::class, 'transactions']);
