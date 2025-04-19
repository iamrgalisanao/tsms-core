<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/panel', fn () => Inertia::render('Admin/Panel'))->name('admin.panel');
});

Route::middleware(['auth', 'role:finance'])->group(function () {
    Route::get('/finance/reports', fn () => Inertia::render('Finance/Reports'))->name('finance.reports');
});

Route::middleware(['auth', 'role:support'])->group(function () {
    Route::get('/support/logs', fn () => Inertia::render('Support/Logs'))->name('support.logs');
});

Route::middleware(['auth', 'role:commercial'])->group(function () {
    Route::get('/commercial/sales', fn () => Inertia::render('Commercial/Sales'))->name('commercial.sales');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn () => Inertia::render('Shared/Dashboard'))->name('dashboard');
});

require __DIR__.'/auth.php';
