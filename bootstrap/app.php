<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(function(){
         // Public or common routes
         require __DIR__.'/../routes/web.php';
         require __DIR__.'/../routes/console.php';
 
         // Shared authenticated routes
         Route::middleware(['auth'])
             ->group(base_path('routes/shared.php'));
 
         // Admin
         Route::middleware(['auth', 'role:admin'])
             ->group(base_path('routes/admin.php'));
 
         // Finance
         Route::middleware(['auth', 'role:finance'])
             ->group(base_path('routes/finance.php'));
 
         // Support
         Route::middleware(['auth', 'role:support'])
             ->group(base_path('routes/support.php'));
 
         // Commercial
         Route::middleware(['auth', 'role:commercial'])
             ->group(base_path('routes/commercial.php'));
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

       
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
