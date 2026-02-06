<?php

namespace App\Providers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Only for SQLite
        if (config('database.default') !== 'sqlite') {
            return;
        }

        $databasePath = config('database.connections.sqlite.database');

        // Ensure database file exists
        if (!file_exists($databasePath)) {
            File::ensureDirectoryExists(dirname($databasePath));
            touch($databasePath);
        }

        // 🚫 Do NOT run during artisan commands (prevents discovery issues)
        if (app()->runningInConsole()) {
            return;
        }

        // ✅ Ensure device_auth table exists on Android
        try {
            if (!\Illuminate\Support\Facades\Schema::hasTable('device_auth')) {
                \Illuminate\Support\Facades\Log::info('Table "device_auth" missing. Triggering migrations...');

                \Illuminate\Support\Facades\Artisan::call('migrate', [
                    '--force' => true,
                ]);

                \Illuminate\Support\Facades\Log::info('Migrations completed on boot.');
            }
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Automated migration failed on boot: ' . $e->getMessage());
        }
    }
}