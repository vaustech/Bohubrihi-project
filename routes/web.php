<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/product_details', function () {
    return view('product_details');
});

// '/account' রুটটি '/users' এর GET রুট দ্বারা হ্যান্ডেল করা হবে
Route::get('/account', [UserController::class, 'index']);


Route::get('/cart', function () {
    return view('cart');
});

// 'GET /users' (যা index মেথডে যায়) - লগইন পেজ দেখায়
// 'POST /users' (যা store মেথডে যায়) - রেজিস্ট্রেশন সাবমিট হয়
Route::resource('/users', UserController::class); // <-- 'u' ছোট হাতের

Route::resource('/products', ProductController::class);

// লগইন সাবমিট করার জন্য নতুন এই রুটটি যোগ করুন
Route::post('/login', [UserController::class, 'checkLogin']);
