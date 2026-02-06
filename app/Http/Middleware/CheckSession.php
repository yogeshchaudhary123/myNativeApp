<?php

namespace App\Http\Middleware;

use App\Models\DeviceAuth;
use App\Http\Controllers\AuthController;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Avoid interfering with auth routes (login/register) to prevent redirect loops
        if ($request->is('login') || $request->is('login/*') || $request->is('register') || $request->is('forgot-password') || $request->is('reset-password')) {
            return $next($request);
        }

        // Check if user is already logged in via session
        if (session()->has('logged_in') && session()->has('user')) {
            return $next($request);
        }

        // Try to auto-login from stored token in SQLite
        try {
            $deviceAuth = DeviceAuth::query()->first();
        } catch (\Illuminate\Database\QueryException $e) {
            // Table doesn't exist yet, redirect to login
            return redirect('/login');
        }

        if ($deviceAuth && $deviceAuth->access_token) {
            // If access token expired, try to refresh using AuthController helper
            if ($deviceAuth->isAccessTokenExpired()) {
                // If refresh token is not available or expired, remove stored auth
                if (!$deviceAuth->hasValidRefreshToken()) {
                    $deviceAuth->delete();
                    return redirect('/login');
                }

                // Attempt to refresh via service
                try {
                    $refreshed = app(\App\Services\TokenService::class)->refresh($deviceAuth);
                    if (!$refreshed) {
                        return redirect('/login');
                    }
                    // reload fresh record
                    $deviceAuth->refresh();
                } catch (\Throwable $e) {
                    $deviceAuth->delete();
                    return redirect('/login');
                }
            }

            try {
                // Validate token with API (optional - you can skip this for faster load)
                $response = Http::withToken($deviceAuth->access_token)
                    ->get(config('nativephp.api_url', 'http://127.0.0.1:8001') . '/api/user'); // Assuming you have a /user endpoint

                if ($response->successful()) {
                    // Token is valid, restore session
                    session([
                        'user' => $deviceAuth->user_data,
                        'access_token' => $deviceAuth->access_token,
                        'refresh_token' => session('refresh_token') ?? null,
                        'logged_in' => true,
                    ]);

                    // Update last validated timestamp
                    $deviceAuth->update(['last_validated_at' => now()]);

                    return $next($request);
                } else {
                    // Token is invalid, clear it
                    $deviceAuth->delete();
                }
            } catch (\Exception $e) {
                // API is down or token is invalid, try without validation
                // For better UX, you can restore session even if API is temporarily down
                session([
                    'user' => $deviceAuth->user_data,
                    'access_token' => $deviceAuth->access_token,
                    'refresh_token' => session('refresh_token') ?? null,
                    'logged_in' => true,
                ]);

                return $next($request);
            }
        }

        // No valid session or stored token, redirect to login
        return redirect('/login');
    }
}

