<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\DataConfirmation;
use App\Http\Middleware\DataEntry;
use App\Http\Middleware\User1Middleware;
use App\Http\Middleware\User2Middleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your middleware aliases here
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'user1' => DataEntry::class,
            'user2' => DataConfirmation::class,
        ]);

        // You can also add global middleware here if needed
        // $middleware->append([
        //     \App\Http\Middleware\YourGlobalMiddleware::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();