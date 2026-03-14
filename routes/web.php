<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactMessageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCouponController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminSubscribeController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::post('/subscribe', [UserController::class, 'subscribe'])->name('subscribe');


Route::resource('contact', ContactController::class)->only(['index', 'store']);
Route::resource('products', ProductController::class)->only(['index', 'show']);


Route::resource('cart', CartController::class)
    ->parameters(['cart' => 'cartItem'])
    ->only(['index', 'store', 'update', 'destroy']);

Route::post('/cart/sync', [CartController::class, 'sync'])->name('cart.sync');
Route::post('/cart/coupon/apply', [CartController::class, 'applyCoupon'])->name('cart.coupon.apply');
Route::delete('/cart/coupon/remove', [CartController::class, 'removeCoupon'])->name('cart.coupon.remove');

Route::resource('orders', OrderController::class)->only(['create', 'store', 'show']);
Route::resource('orders.payments', PaymentController::class)->only(['create', 'store']);

Route::get('/register', [AuthController::class, 'createRegister'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');

Route::get('/login', [AuthController::class, 'createLogin'])->name('login');
Route::post('/login', [AuthController::class, 'storeLogin'])->name('login.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Socialite Routes
Route::get('/auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'createForgotPassword'])
    ->middleware('guest')
    ->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'storeForgotPassword'])
    ->middleware('guest')
    ->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'createResetPassword'])
    ->middleware('guest')
    ->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'storeResetPassword'])
    ->middleware('guest')
    ->name('password.update');

Route::get('/email/verify', [AuthController::class, 'verificationNotice'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verificationVerify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [AuthController::class, 'verificationSend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

//User Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('account', AccountController::class)->only(['index', 'update']);
    Route::resource('wishlist', WishlistController::class)->only(['index', 'store', 'destroy']);
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    
    // Users Management
    Route::resource('users', AdminUserController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);

    // Contact Messages
    Route::resource('contacts', AdminContactMessageController::class)->only(['index', 'show', 'edit', 'update', 'destroy']);
    
    // Orders Management
    Route::resource('orders', AdminOrderController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::post('/orders/{order}/verify', [AdminOrderController::class, 'verify'])->name('orders.verify');

    // Categories Management
    Route::resource('categories', AdminCategoryController::class);
    
    // Products Management
    Route::resource('products', AdminProductController::class);

    // Coupon Management
    Route::resource('coupons', AdminCouponController::class);

    // Subscribers Management
    Route::resource('subscribes', AdminSubscribeController::class)->only(['index', 'edit', 'update', 'destroy']);

    // Report Generation
    Route::get('/reports', [AdminReportController::class, 'index'])->name('reports.index');
});
