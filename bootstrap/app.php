<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'guest.karyawan' => \App\Http\Middleware\KaryawanRedirectIfAuthenticated::class,
            'auth.karyawan' => \App\Http\Middleware\KaryawanAuthenticate::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
    })->create();
