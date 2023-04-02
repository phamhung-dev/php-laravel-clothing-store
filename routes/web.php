<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ AuthController, ApplicationController, CouponController, OrderDetailController, ProductController, ProductInventoryController, RoleUserController, UserController, CartItemController };
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

Route::name('admin.')->prefix('admin')->group(function() {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/coupon', [CouponController::class, 'index'])->name('coupon');
    Route::get('/coupon/create', [CouponController::class, 'showCreateForm'])->name('coupon.create');
    Route::post('/coupon/create', [CouponController::class, 'create'])->name('coupon.create.submit');
    Route::post('/coupon/update{id}', [CouponController::class, 'update'])->name('coupon.update');
    Route::get('/coupon/{coupon}/edit', [CouponController::class, 'edit'])->name('coupon.edit');

    Route::get('/user', [UserController::class, 'showUsers'])->name('user');
    Route::get('/user/{id}/info', [UserController::class, 'showUserDetail'])->name('user.info');

    Route::get('/admin-user', [UserController::class, 'showAdminUsers'])->name('adminUser');
    Route::get('/admin-user/create', [UserController::class, 'showFormCreate'])->name('adminUser.create');
    Route::post('/admin-user/create', [UserController::class, 'storeAdminUser'])->name('adminUser.create');
    Route::post('/admin-user/update{id}', [UserController::class, 'updateAdminUser'])->name('adminUser.update');
    Route::get('/admin-user/profile', [UserController::class, 'showAdminProfile'])->name('adminUser.profile');
    Route::post('/admin-user/update-profile/{id}', [UserController::class, 'updateProfile'])->name('adminUser.updateProfile');
    Route::get('/admin-user/{user}/edit', [UserController::class, 'editAdminUser'])->name('adminUser.edit');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'showFormCreate'])->name('product.create');
    Route::post('/product/create', [ProductController::class, 'store'])->name('product.create');
    Route::get('/product/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update{id}', [ProductController::class, 'update'])->name('product.update');

    Route::get('/inventory', [ProductInventoryController::class, 'index'])->name('inventory');
    Route::get('/inventory/create', [ProductInventoryController::class, 'showFormCreate'])->name('inventory.create');
    Route::post('/inventory/create', [ProductInventoryController::class, 'create'])->name('inventory.create');
    Route::get('/inventory/{id}/edit', [ProductInventoryController::class, 'edit'])->name('inventory.edit');
    Route::post('/inventory/update{id}', [ProductInventoryController::class, 'update'])->name('inventory.update');

    Route::get('/order-detail', [OrderDetailController::class, 'index'])->name('order');
    Route::get('/order-detail/{id}/edit', [OrderDetailController::class, 'showOrderDetailInfo'])->name('order.edit');
    Route::post('/order-detail/update-status', [OrderDetailController::class, 'updateOrderStatus'])->name('coupon.updateStatus');

    Route::get('/role', [RoleUserController::class, 'index'])->name('role');
    Route::get('/role/create', [RoleUserController::class, 'showFormCreate'])->name('role.create');
    Route::post('/role/create', [RoleUserController::class, 'store'])->name('role.create');
    Route::delete('/admin/role/{user_id}/{role_id}', [RoleUserController::class, 'destroy'])->name('role.destroy');


});