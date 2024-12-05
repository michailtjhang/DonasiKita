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
        Schema::create('media', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('cloudinary_public_id'); // ID file di Cloudinary
            $table->string('cloudinary_url'); // URL file di Cloudinary
            $table->string('type')->nullable(); // Jenis media (e.g., 'image', 'video')
            $table->timestamps();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
