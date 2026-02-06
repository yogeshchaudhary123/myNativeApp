<?php

namespace App\Http\Middleware;

use App\Models\DeviceAuth;
use App\Http\Controllers\AuthController;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TokenRefreshMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Don't force redirects on auth pages to avoid redirect loops
        if ($request->is('login') || $request->is('login/*') || $request->is('register') || $request->is('forgot-password') || $request->is('reset-password')) {
            return $next($request);
        }
        $deviceAuth = DeviceAuth::first();

        if (!$deviceAuth) {
            return redirect('/login');
        }

        // If access token expired, try to refresh it
        if ($deviceAuth->isAccessTokenExpired()) {
            // If refresh token missing or expired, force login
            if (!$deviceAuth->hasValidRefreshToken()) {
                $deviceAuth->delete();
                return redirect('/login');
            }

            try {
                $refreshed = app(\App\Services\TokenService::class)->refresh($deviceAuth);
                if (!$refreshed) {
                    return redirect('/login');
                }
                // refresh the model to have latest values
                $deviceAuth->refresh();
            } catch (\Throwable $e) {
                $deviceAuth->delete();
                return redirect('/login');
            }
        }

        // Attach access token to session if present
        if ($deviceAuth->access_token && !session()->has('access_token')) {
            session(['access_token' => $deviceAuth->access_token]);
        }

        return $next($request);
    }
}
