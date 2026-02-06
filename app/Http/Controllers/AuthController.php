<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Services\TokenService;

class AuthController extends Controller
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.auth_api.url');
    }

    public function showLogin()
    {
        if (session('logged_in')) {
            return redirect('/');
        }

        return view('auth.login');
    }

    public function showRegister()
    {
        if (session('logged_in')) {
            return redirect('/');
        }

        return view('auth.register');
    }

    public function login(Request $request, TokenService $tokenService)
    {
        Log::info('Login Attempt Payload:', $request->all());

        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/api/login", $request->only('email', 'password'))->throw();

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'Invalid credentials',
                    'errors' => ['email' => ['Invalid credentials']]
                ], 422);
            }

            $request->session()->regenerate();
            $tokenService->store($response->json());

            return response()->json(['success' => true, 'redirect' => '/']);
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return response()->json([
                'message' => $e->response->json()['message'] ?? 'API Error',
                'errors' => ['main_error' => [$e->response->json()['message'] ?? 'API Error']]
            ], 422);
        }
    }

    public function register(Request $request, TokenService $tokenService)
    {
        Log::info('Register Attempt Payload:', $request->all());

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/api/register", $request->all());

            if (!$response->successful()) {
                return response()->json([
                    'message' => 'Registration failed',
                    'errors' => ['email' => ['Registration failed']]
                ], 422);
            }

            $request->session()->regenerate();
            $tokenService->store($response->json());

            return response()->json(['success' => true, 'redirect' => '/']);
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return response()->json([
                'message' => $e->response->json()['message'] ?? 'API Error',
                'errors' => ['main_error' => [$e->response->json()['message'] ?? 'API Error']]
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        if ($token = session('access_token')) {
            try {
                $response = Http::withToken($token)
                    ->acceptJson()
                    ->get("{$this->apiUrl}/api/logout");
            } catch (\Illuminate\Http\Client\RequestException $e) {
                return back()->withErrors(['main_error' => $e->response->json()['message'] ?? 'API Error']);
            }
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        \App\Models\DeviceAuth::query()->delete();

        return redirect()->route('login');
    }
}
