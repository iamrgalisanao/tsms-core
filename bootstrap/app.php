<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        using: function () {
            Route::middleware('web')
                 ->group(base_path('routes/web.php'));

            Route::middleware('web') // Auth routes need web middleware
                 ->group(base_path('routes/auth.php'));

            Route::middleware(['web', 'auth', 'role:admin'])
                 ->group(base_path('routes/admin.php'));

            Route::middleware(['web', 'auth', 'role:finance'])
                 ->group(base_path('routes/finance.php'));

            Route::middleware(['web', 'auth', 'role:support'])
                 ->group(base_path('routes/support.php'));

            Route::middleware(['web', 'auth', 'role:commercial'])
                 ->group(base_path('routes/commercial.php'));

            Route::middleware(['web', 'auth']) // Shared authenticated routes
                 ->group(base_path('routes/shared.php'));
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register our custom role middleware
        $middleware->alias([
            'role' => \App\Http\Middleware\RoleMiddleware::class,
        ]);

        // Define the web middleware group
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ]);

        // Append Inertia & preload headers
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();
