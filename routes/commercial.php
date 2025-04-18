<?php

use Illuminate\Support\Facades\Route;

Route::get('/commercial/logs', function () {
    return inertia('Commercial/Logs');
})->name('commercial.logs');
