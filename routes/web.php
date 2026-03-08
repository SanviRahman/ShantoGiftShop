<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/',[HomeController::class,'home'])->name('home');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::get('/about',[HomeController::class,'about'])->name('about');
Route::get('/products',[HomeController::class,'products'])->name('products');
Route::get('/cart',[HomeController::class,'cart'])->name('cart');


//User Routes
Route::get('/user/account',[UserController::class,'account'])->name('account');
Route::get('/user/wishlist',[UserController::class,'wishlist'])->name('wishlist');