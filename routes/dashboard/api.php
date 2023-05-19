<?php

use App\Http\Controllers\Dashboard\ApiController;
use Illuminate\Support\Facades\Route;


Route::name('api.')->prefix('api')->group(function () {
    Route::post('/users', [ApiController::class, 'usersList'])->name('users.list');
    Route::post('/comments', [ApiController::class, 'commentsList'])->name('comments.list');
    Route::get('/users-with-comments', [ApiController::class, 'usersWithComments'])->name('usersWithComments');
});
