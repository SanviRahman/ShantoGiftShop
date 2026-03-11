<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::resource('contact', ContactController::class)->only(['index', 'store']);
Route::resource('products', ProductController::class)->only(['index', 'show']);

Route::resource('cart', CartController::class)
    ->parameters(['cart' => 'cartItem'])
    ->only(['index', 'store', 'update', 'destroy']);

Route::post('/cart/sync', [CartController::class, 'sync'])->name('cart.sync');
Route::post('/cart/coupon/apply', [CartController::class, 'applyCoupon'])->name('cart.coupon.apply');
Route::delete('/cart/coupon/remove', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

Route::resource('orders', OrderController::class)->only(['create', 'store']);
Route::resource('orders.payments', PaymentController::class)->only(['create', 'store']);

Route::get('/register', [AuthController::class, 'createRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::resource('account', AccountController::class)->only(['index', 'update']);
    Route::resource('wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);
});
