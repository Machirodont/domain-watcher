<?php

use App\Http\Controllers\DomainController;
use App\Http\Middleware\CheckIsActivated;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->middleware([CheckIsActivated::class])
    ->name('domain.')
    ->prefix('domain')
    ->group(function () {
        Route::get('list', [DomainController::class, 'index'])->name('list');
        Route::get('edit_form', [DomainController::class, 'editForm'])->name('edit_form');
        Route::post('edit', [DomainController::class, 'edit'])->name('edit');
        Route::post('reset', [DomainController::class, 'reset'])->name('reset');
        Route::post('delete', [DomainController::class, 'delete'])->name('delete');
});
