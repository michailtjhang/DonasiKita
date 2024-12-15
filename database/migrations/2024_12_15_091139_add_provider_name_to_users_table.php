<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('provider_id')->nullable(); // Menambahkan provider ID
            $table->string('provider_name')->nullable(); // Menambahkan provider name
            $table->string('access_token', 500)->nullable(); // Menambahkan access token dengan panjang maksimal 500 karakter
            $table->string('refresh_token', 500)->nullable(); // Menambahkan refresh token dengan panjang maksimal 500 karakter
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('provider_id');
            $table->dropColumn('provider_name');
            $table->dropColumn('access_token');
            $table->dropColumn('refresh_token');
        });
    }
};
