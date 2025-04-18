<?php
// routes/finance.php
use Illuminate\Support\Facades\Route;

Route::get('/finance/reports', function () {
    return inertia('Finance/Reports');
})->name('finance.reports');
