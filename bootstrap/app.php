<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Pest\ArchPresets\Custom;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        
        // Placed safely within the web stack group where Session and Cookies are fully initialized
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class, // Run this first in the web group to initialize language strings before Inertia shares data
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

      $middleware->alias([
    'custom.role' => \App\Http\Middleware\EnsureUserHasRole::class,
    'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
    'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
    'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();