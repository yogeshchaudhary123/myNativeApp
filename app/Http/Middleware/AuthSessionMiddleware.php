<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\DeviceAuth;
use App\Services\TokenService;

class AuthSessionMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Allow auth pages
        if ($request->is('login', 'login/*', 'register', 'forgot-password', 'reset-password')) {
            return $next($request);
        }

        // Session already valid
        if (session('logged_in') === true && session()->has('user')) {
            return $next($request);
        }

        $auth = DeviceAuth::first();

        if (!$auth) {
            return redirect()->route('login');
        }

        $tokenService = app(TokenService::class);

        // Refresh if needed
        if ($auth->isAccessTokenExpired()) {
            if (!$tokenService->refresh($auth)) {
                return redirect()->route('login');
            }
        }

        // Restore session from SQLite
        $tokenService->restoreSession($auth);

        return $next($request);
    }
}
