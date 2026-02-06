<?php
namespace App\Services;

use App\Models\DeviceAuth;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class TokenService
{
    protected string $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.auth_api.url');
    }

    public function store(array $data): void
    {
        DeviceAuth::query()->delete();

        DeviceAuth::create([
            'access_token' => $data['accessToken'],
            'refresh_token' => $data['refreshToken'],
            'user_data' => $data['user'],
            'access_token_expires_at' => now()->addSeconds($data['expires_in']),
            'refresh_token_expires_at' => Carbon::parse(
                $data['refresh_expires_at'] ?? now()->addDays(60)
            ),
            'last_validated_at' => now(),
        ]);
    }

    public function restoreSession(DeviceAuth $auth): void
    {
        session([
            'logged_in' => true,
            'user' => $auth->user_data,
            'access_token' => $auth->access_token,
            'refresh_token' => $auth->refresh_token,
        ]);
    }

    public function refresh(DeviceAuth $auth): bool
    {
        if ($auth->refreshTokenExpired()) {
            $auth->delete();
            return false;
        }

        $response = Http::post("{$this->apiUrl}/api/refresh", [
            'refreshToken' => $auth->refresh_token,
        ]);

        if (!$response->successful()) {
            $auth->delete();
            return false;
        }

        $data = $response->json();

        $auth->update([
            'access_token' => $data['accessToken'],
            'refresh_token' => $data['refreshToken'],
            'access_token_expires_at' => now()->addSeconds($data['expires_in']),
            'refresh_token_expires_at' => Carbon::parse(
                $data['refresh_expires_at'] ?? now()->addDays(60)
            ),
            'last_validated_at' => now(),
        ]);

        $this->restoreSession($auth);

        return true;
    }
}
