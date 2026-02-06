<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class DeviceAuth extends Model
{
    protected $table = 'device_auth';

    protected $fillable = [
        'access_token',
        'refresh_token',
        'user_data',
        'access_token_expires_at',
        'refresh_token_expires_at',
        'last_validated_at',
    ];

    protected $casts = [
        'user_data' => 'array',
        'access_token_expires_at' => 'datetime',
        'refresh_token_expires_at' => 'datetime',
        'last_validated_at' => 'datetime',
    ];

    /**
     * Check if access token is expired
     */
    public function isAccessTokenExpired(): bool
    {
        if (!$this->access_token_expires_at) {
            return false;
        }
        return Carbon::now()->greaterThan($this->access_token_expires_at);
    }

    /**
     * Check if refresh token is expired
     */
    public function isRefreshTokenExpired(): bool
    {
        if (!$this->refresh_token_expires_at) {
            return false;
        }
        return Carbon::now()->greaterThan($this->refresh_token_expires_at);
    }

    /**
     * Check if refresh token is still valid
     */
    public function hasValidRefreshToken(): bool
    {
        return $this->refresh_token && !$this->isRefreshTokenExpired();
    }
}
