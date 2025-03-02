<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/show/{product}', [HomeController::class, 'show'])->name('front.products.show');

Auth::routes();

Route::middleware('auth:web')->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('products', ProductController::class);
    Route::post('products/{product}/status', [ProductController::class, 'updateStatus'])->name('products.updateStatus');
    Route::post('products/review', [ReviewController::class, 'addReviewToProduct'])->name('reviews.store');
});
