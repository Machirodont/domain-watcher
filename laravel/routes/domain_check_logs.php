<?php

use App\Http\Controllers\DomainCheckLogController;
use App\Http\Middleware\CheckIsActivated;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')
    ->middleware([CheckIsActivated::class])
    ->name('domain_check_log.')
    ->prefix('domain_check_log')
    ->group(function () {
        Route::get('list/{domainId}', [DomainCheckLogController::class, 'index'])->name('list');
});
