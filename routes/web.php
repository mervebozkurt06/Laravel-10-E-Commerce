<?php

use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CustomAuthController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ShopCartController;

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

Route::middleware('auth')->group(function () {

    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category_create');
    Route::post('category/store', [CategoryController::class, 'store'])->name('category_store');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::get('category/show/{id}', [CategoryController::class, 'show'])->name('category_show');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category_update');
    Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category_destroy');

    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('product/create', [ProductController::class, 'create'])->name('product_create');
    Route::post('product/store', [ProductController::class, 'store'])->name('product_store');
    Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('product_edit');
    Route::post('product/update/{id}', [ProductController::class, 'update'])->name('product_update');
    Route::get('product/destroy/{id}', [ProductController::class, 'destroy'])->name('product_destroy');


    Route::get('shopcart', [ShopCartController::class, 'index'])->name('shopcart');
    Route::post('shopcart/store/{id}', [ShopCartController::class, 'store'])->name('shopcart_store');
    Route::put('shopcart/update/{id}', [ShopCartController::class, 'update'])->name('shopcart_update');
    Route::get('shopcart/destroy/{id}', [ShopCartController::class, 'destroy'])->name('shopcart_destroy');

    Route::get('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');
    Route::get('/mark-one-as-read/{id}', [NotificationController::class, 'markOneAsRead'])->name('mark-one-as-read');

    Route::get('order/index', [OrderController::class, 'index'])->name('order_index');
    Route::get('myOrders', [OrderController::class, 'myOrders'])->name('myOrders');
    Route::get('order/{id}', [OrderController::class, 'show'])->name('order_show');
    Route::post('order/store', [OrderController::class, 'store'])->name('order_store');
    Route::get('download-pdf/{order_id}', [OrderController::class, 'downloadPDF'])->name('download_pdf');

});

Route::get('dashboard', [CustomAuthController::class, 'dashboard']);
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

