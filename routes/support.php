<?php

use Illuminate\Support\Facades\Route;

Route::get('/support/logs', function () {
    return inertia('Support/Logs');
})->name('support.logs');
