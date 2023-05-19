<?php

use App\Http\Controllers\Dashboard\AuthController;
use Illuminate\Support\Facades\Route;


Route::name('dashboard.')->prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login-page');
    Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('throttle:20,60');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth:admin');
});
