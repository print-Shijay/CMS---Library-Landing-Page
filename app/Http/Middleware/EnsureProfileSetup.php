<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class EnsureProfileSetup
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // 1. If user is NOT logged in, let standard auth middleware handle it.
        if (!$user) {
            return $next($request);
        }

        // 2. If user hasn't verified/setup account AND they are not already on the setup page
        // (We check the route name to prevent an infinite redirect loop)
        if (is_null($user->email_verified_at) && !$request->routeIs('account.setup.*') && !$request->routeIs('logout')) {
            return redirect()->route('account.setup.create');
        }

        // 3. If user IS verified but tries to access setup page, send them to dashboard
        if (!is_null($user->email_verified_at) && $request->routeIs('account.setup.*')) {
             return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}