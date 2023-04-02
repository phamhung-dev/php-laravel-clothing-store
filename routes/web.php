<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ AuthController, ApplicationController, UserController, ProductController, OrderDetailController, CartItemController };
use App\Http\Middleware\UserAuthenticate;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ApplicationController::class, 'home'])->name('home');

Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');

Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');

Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('forgot-password');
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password.submit');

Route::get('home', [ApplicationController::class, 'home'])->name('home');
Route::get('products', [ApplicationController::class, 'products'])->name('products');
Route::get('order-tracking', [ApplicationController::class, 'orderTracking'])->name('order-tracking');
Route::get('about-us', [ApplicationController::class, 'aboutUs'])->name('about-us');
Route::get('contact', [ApplicationController::class, 'contact'])->name('contact');

Route::name('user')->prefix('user')->group(function() {
    Route::name('.my-account')->prefix('my-account')->group(function() {
        Route::get('/', [UserController::class, 'myAccount'])->name('');
    });
    Route::name('.my-cart')->prefix('my-cart')->group(function() {
        Route::get('/', [CartItemController::class, 'myCart'])->name('');
        Route::post('add-to-cart', [CartItemController::class, 'addToCart'])->name('.add-to-cart');
    });
    Route::get('my-wishlist', [UserController::class, 'myWishlist'])->name('.my-wishlist');
});

Route::name('products')->prefix('products')->group(function() {
    Route::get('single-product', [ProductController::class, 'singleProduct'])->name('.single-product');
});

Route::name('order-tracking')->prefix('order-tracking')->group(function() {
    Route::get('order-detail', [OrderDetailController::class, 'orderDetail'])->name('.order-detail');
});