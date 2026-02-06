<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]); 
        try {
            $response = Http::post("{$this->apiUrl}/api/login", $request->only('email', 'password'))->throw();
            if (!$response->successful()) {
                return back()->withErrors(['email' => 'Invalid credentials']);
            }

            $request->session()->regenerate();
            $tokenService->store($response->json());

            return redirect('/');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return back()->withErrors(['main_error' => $e->response->json()['message'] ?? 'API Error']);
        }
       
    }

    public function register(Request $request, TokenService $tokenService)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        try {
            $response = Http::post("{$this->apiUrl}/api/register", $request->all());

            if (!$response->successful()) {
                return back()->withErrors(['email' => 'Registration failed']);
            }

            $request->session()->regenerate();
            $tokenService->store($response->json());

            return redirect('/');
        } catch (\Illuminate\Http\Client\RequestException $e) {
            return back()->withErrors(['main_error' => $e->response->json()['message'] ?? 'API Error']);
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
