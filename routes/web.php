<?php

use Illuminate\Support\Facades\Route;
use Henrymanyonyi\Impersonation\Http\Controllers\ImpersonationController;
use Henrymanyonyi\Impersonation\Http\Middleware\AllowImpersonation;

Route::middleware(['web', 'auth', AllowImpersonation::class])->group(function () {

    Route::post('/impersonate/{user}', [ImpersonationController::class, 'start'])
        ->name('impersonate.start');

    Route::post('/impersonate/leave', [ImpersonationController::class, 'stop'])
        ->name('impersonate.stop');
});