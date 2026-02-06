<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('device_auth', function (Blueprint $table) {
            // Remove old single token column
            $table->dropColumn('api_token');

            // Add separate access and refresh token columns
            $table->text('access_token')->after('id');
            $table->text('refresh_token')->after('access_token');

            // Add expiration timestamps
            $table->timestamp('access_token_expires_at')->nullable()->after('refresh_token');
            $table->timestamp('refresh_token_expires_at')->nullable()->after('access_token_expires_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('device_auth', function (Blueprint $table) {
            $table->dropColumn(['access_token', 'refresh_token', 'access_token_expires_at', 'refresh_token_expires_at']);
            $table->text('api_token')->after('id');
        });
    }
};
