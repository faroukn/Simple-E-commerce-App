<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\OrderController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[AppController::class,'index'])->name('app.index');

Route::get('/shop',[ShopController::class,'index'])->name('shop.index');
Route::get('/product/{slug}',[ShopController::class,'productDetails'])->name('shop.product.details');

Route::get('/cart',[CartController::class,'index'])->name('cart.index');
Route::post('/cart',[CartController::class,'create'])->name('cart.store');
Route::put('/cart',[CartController::class,'update'])->name('cart.update');
Route::delete('/cart',[CartController::class,'destroy'])->name('cart.destroy');
Route::delete('/cart/{rowId}',[CartController::class,'delete'])->name('cart.delete');

Route::get('/wishlist',[WishListController::class,'index'])->name('wishlist.index');
Route::post('/wishlist',[WishListController::class,'create'])->name('wishlist.store');
Route::put('/wishlist',[WishListController::class,'update'])->name('wishlist.update');
Route::delete('/wishlist',[WishListController::class,'destroy'])->name('wishlist.destroy');
Route::delete('/wishlist/{rowId}',[WishListController::class,'delete'])->name('wishlist.delete');

Auth::routes();

Route::middleware(['auth','throttle:web'])->group(function (){
    Route::get('/my-account',[UserController::class,'index'])->name('user.index');
    Route::GET('/order',[OrderController::class,'index'])->name('order.index');
    Route::post('/order',[OrderController::class,'store'])->middleware(\App\Http\Middleware\CheckPayment::class)->name('order.create');
    Route::match(['get','post'],'/order/payment',[OrderController::class,'create'])->middleware(\App\Http\Middleware\CheckPayment::class)->name('order.payment');
    Route::GET('/order/{orderId}',[OrderController::class,'show'])->name('order.show');
    Route::delete('/order/{orderId}',[OrderController::class,'delete'])->name('order.delete');
});

Route::middleware(['auth','auth.admin'])->controller(AdminController::class)->prefix('admin')->name('admin.')->group(function (){
    Route::get('/','index')->name('index');
    Route::get('/products/','productsIndex')->name('products.index');
    Route::get('/users','usersIndex')->name('users.index');
    Route::get('/user/{userId}','userShow')->where('userId','[0-9]+')->name('users.show');
    Route::get('/orders','ordersIndex')->name('orders.index');
    Route::get('/order/{order}','orderShow')->name('orders.show');
    Route::put('/order/{order}','orderDeliver')->name('orders.update');
    Route::delete('/order/{order}','orderCancel')->name('orders.delete');
});

