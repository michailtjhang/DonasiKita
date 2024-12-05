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
        Schema::create('payment_receipts', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->uuid('donation_id'); // FK ke tabel donations
            $table->string('cloudinary_public_id'); // ID file di Cloudinary
            $table->string('cloudinary_url'); // URL file di Cloudinary
            $table->timestamp('uploaded_at')->nullable(); // Waktu unggah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_receipts');
    }
};
