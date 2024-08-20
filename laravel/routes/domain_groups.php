<?php

use App\Http\Controllers\DomainGroupController;
use App\Http\Middleware\CheckIsActivated;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->middleware([CheckIsActivated::class])
    ->name('domain_group.')
    ->prefix('domain_group')
    ->group(function () {
        Route::get('list', [DomainGroupController::class, 'index'])->name('list');
        Route::get('edit_form', [DomainGroupController::class, 'editForm'])->name('edit_form');
        Route::post('edit', [DomainGroupController::class, 'edit'])->name('edit');
        Route::post('delete', [DomainGroupController::class, 'delete'])->name('delete');
    });
