<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ AuthController, ApplicationController, CouponController, OrderDetailController, ProductController, ProductInventoryController, RoleUserController, UserController };
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

Route::get('/', function () {
    return view('welcome');
});

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

Route::name('user.')->prefix('user')->group(function() {
    Route::get('my-account', [UserController::class, 'myAccount'])->name('my-account');
    Route::get('my-cart', [UserController::class, 'myCart'])->name('my-cart');
    Route::get('my-wishlist', [UserController::class, 'myWishlist'])->name('my-wishlist');
});

Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('/coupon/create', [CouponController::class, 'showCreateForm'])->name('coupon.create');
    Route::post('/coupon/create', [CouponController::class, 'create'])->name('coupon.create.submit');
    Route::get('/coupon/{coupon}/edit', [CouponController::class, 'edit'])->name('coupon.edit');

    Route::get('/user', [UserController::class, 'showUsers'])->name('user');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'showFormCreate'])->name('product.create');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');

    Route::get('/inventory', [ProductInventoryController::class, 'index'])->name('inventory');
    Route::get('/inventory/create', [ProductInventoryController::class, 'showFormCreate'])->name('inventory.create');

    Route::get('/order-detail', [OrderDetailController::class, 'index'])->name('order');

    Route::get('/role', [RoleUserController::class, 'index'])->name('role');
    Route::get('/role/create', [RoleUserController::class, 'showFormCreate'])->name('role.create');
});