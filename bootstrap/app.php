<?php

use App\Http\Middleware\SetLocale;
use App\Http\Middleware\LogVisitor;
use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminUserMiddleware;
use App\Http\Middleware\VerifyEmailMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'useradmin' => AdminUserMiddleware::class,
            'verifiedEmail' => VerifyEmailMiddleware::class,
            'logvisitor' => LogVisitor::class,
            'setlocale' => SetLocale::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
