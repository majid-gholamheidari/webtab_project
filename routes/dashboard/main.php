<?php

use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\IndexController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:admin')->name('dashboard.')->prefix('dashboard')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('user', UserController::class);
    Route::resource('comment', CommentController::class);
});



