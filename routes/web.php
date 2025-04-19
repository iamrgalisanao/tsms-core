<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

// Restore original logic
// Route::get('/', function () {
//     return 'Root route is working!';
// });

Route::get('/', function () {
    if (!Auth::check()) {
        Log::info('User is not authenticated. Redirecting to login.');
        return redirect()->route('login');
    }

    $user = Auth::user();
    Log::info('Authenticated user:', ['id' => $user->id, 'roles' => $user->roles->pluck('name')]);

    if ($user && $user->hasRole('admin')) {
        Log::info('User has admin role. Redirecting to admin dashboard.');
        return redirect()->route('admin.dashboard');
    }

    if ($user && $user->hasRole('finance')) {
        Log::info('User has finance role. Redirecting to finance reports.');
        return redirect()->route('finance.reports');
    }

    if ($user && $user->hasRole('support')) {
        Log::info('User has support role. Redirecting to support logs.');
        return redirect()->route('support.logs');
    }

    if ($user && $user->hasRole('commercial')) {
        Log::info('User has commercial role. Redirecting to commercial sales.');
        return redirect()->route('commercial.sales');
    }

    Log::info('User authenticated but has no specific role. Logging out and redirecting to login.');
    Auth::logout();
    return redirect()->route('login');
});

// Other routes previously defined here were removed as they are loaded via bootstrap/app.php
