<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Add other shared routes here if needed

Route::get('/dashboard', function () {
    // You might want specific logic here, or just render the view
    return Inertia::render('Shared/Dashboard');
})->name('dashboard'); // Ensure it's named 'dashboard'
