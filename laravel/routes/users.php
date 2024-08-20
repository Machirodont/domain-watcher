<?php

use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckIsAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->middleware([CheckIsAdmin::class])
    ->name('user.')
    ->prefix('user')
    ->group(function () {
        Route::get('list', [UserController::class, 'index'])->name('list');
        Route::post('activate', [UserController::class, 'activate'])->name('activate');
        Route::post('deactivate', [UserController::class, 'deactivate'])->name('deactivate');
});
