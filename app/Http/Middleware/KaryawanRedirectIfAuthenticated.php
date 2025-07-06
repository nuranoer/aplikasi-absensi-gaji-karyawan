<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KaryawanRedirectIfAuthenticated extends RedirectIfAuthenticated
{

    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        return parent::handle($request, $next, 'karyawan');
    }
    protected function redirectTo(Request $request): ?string
    {
        return route('karyawan.dashboard');
    }
}
