<?php

use App\Http\Controllers\Adm\AdminController;
use App\Http\Controllers\PromoCodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Auth2\RegisterController;
use App\Http\Controllers\Auth2\LoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Adm\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LangController;

Route::get('/', function () {
    return redirect()->route('shops.index');
});

Route::get('/lang/{lang}', [LangController::class, 'switchLang'])->name('switch.lang');


Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('shops', ShopController::class)->except('register', 'login', 'index');
//    Route::post('/shops/{shop}/rate',[ShopController::class,'rate'])->name('shops.rate');
    Route::post('/shops/{shop}/rate', [ShopController::class, 'rate'])->name('shops.rate');
    Route::post('/shops/{shop}/unrate', [ShopController::class, 'unrate'])->name('shops.unrate');
    Route::post('cart/{shop}/putToCart', [CartController::class, 'putToCart'])->name('cart.puttocart');
    Route::post('/cart/{shop}/removecart', [CartController::class, 'remove'])->name('cart.removecart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'buy'])->name('cart.buy');
    Route::post('/cart/{shop}/deleteFromCart', [CartController::class, 'deleteFromCart'])->name('cart.deletefromcart');
    Route::post('/cart/deleteallcart', [CartController::class, 'deleteallcart'])->name('cart.deleteallcart');

    Route::prefix('adm')->as('adm.')->middleware('hasrole:moderator,admin')->group(function () {

        Route::get('/cart', [UserController::class, 'cart'])->name('cartu.index');
        Route::get('/cart/{cart}/confirm', [UserController::class, 'confirm'])->name('cart.confirm');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/search', [CategoryController::class, 'index'])->name('categories.search');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
        Route::resource('/promocode',PromoCodeController::class)->except('equalGet');
        Route::get('comments',[CommentController::class,'index'])->name('comments');
        Route::middleware('hasrole:admin')->group(function () {
            Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/search', [UserController::class, 'index'])->name('users.search');
        Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
        Route::put('/users/{user}/ban', [UserController::class, 'ban'])->name('users.ban');
        Route::put('/users/{user}/unban', [UserController::class, 'unban'])->name('users.unban');
            Route::get('/users/{user}/edit',[UserController::class, 'edit'])->name('users.edit');
            Route::put('/users/{user}/update',[UserController::class, 'update'])->name('users.update');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/search', [RoleController::class, 'index'])->name('roles.search');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    });
});
});
Route::resource('/comments', CommentController::class)->only('store', 'destroy', 'update');
Route::resource('shops', ShopController::class)->only('register', 'login', 'index');
Route::get('/shops/category/{category}', [ShopController::class, 'ShopCat'])->name('shops.category');
Route::get('/categories',[CategoryController::class,'categories'])->name('categories');
Route::get('/promocode/equal',[PromoCodeController::class,'equalGet'])->name('promocode.equalGet');
Route::post('/promocode/equal',[PromoCodeController::class,'equal'])->name('promocode.equal');



//Auth::routes();
Route::get('register', [RegisterController::class, 'create'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::get('login', [LoginController::class, 'create'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

