<?php

use Illuminate\Support\Facades\Route;
use Cobuild\Impersonation\Http\Controllers\ImpersonationController;

Route::middleware(['web', 'auth'])->group(function () {

    Route::post('/impersonate/{user}', [ImpersonationController::class, 'start'])
        ->name('impersonate.start');

    Route::post('/impersonate/leave', [ImpersonationController::class, 'stop'])
        ->name('impersonate.stop');
});
