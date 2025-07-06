<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KaryawanAuthenticate extends \Illuminate\Auth\Middleware\Authenticate
{
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, ['karyawan']);

        return $next($request);
    }
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            return route('karyawan.login');
        }

        return null;
    }
}
