<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = $request->user();
        Log::info('User authenticated:', ['id' => $user->id, 'email' => $user->email, 'roles' => $user->roles->pluck('name')]);

        if ($user->hasRole('admin')) {
            Log::info('User has admin role. Redirecting to admin.dashboard.');
            return redirect()->intended(route('admin.dashboard', absolute: false));
        }

        if ($user->hasRole('finance')) {
            Log::info('User has finance role. Redirecting to finance.reports.');
            return redirect()->intended(route('finance.reports', absolute: false));
        }

        if ($user->hasRole('support')) {
            Log::info('User has support role. Redirecting to support.logs.');
            return redirect()->intended(route('support.logs', absolute: false));
        }

        if ($user->hasRole('commercial')) {
            Log::info('User has commercial role. Redirecting to commercial.sales.');
            return redirect()->intended(route('commercial.sales', absolute: false));
        }

        // If user has no specific role, log them out and redirect to login
        Log::warning('User authenticated but has no valid application role. Logging out.', ['id' => $user->id]);
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'You do not have permission to access the application.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
