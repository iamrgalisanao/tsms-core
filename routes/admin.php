<?php

use Illuminate\Support\Facades\Route;

Route::get('/admin/dashboard', function () {
    return inertia('Admin/Dashboard');
})->name('admin.dashboard');
Route::get('/admin/users', function () {
    return inertia('Admin/Users');
})->name('admin.users.index');