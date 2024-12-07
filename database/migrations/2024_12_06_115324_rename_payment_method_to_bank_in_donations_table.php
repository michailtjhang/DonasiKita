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
        Schema::table('donations', function (Blueprint $table) {
            $table->renameColumn('payment_method', 'bank');
            $table->string('sender_name')->nullable()->after('bank');
            $table->string('tracking_number')->nullable()->after('sender_name'); // Menambahkan kolom tracking_number
            $table->index('tracking_number'); // Menambahkan indeks pada kolom tracking_number
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->renameColumn('bank', 'payment_method'); // Membalikkan perubahan nama kolom
            $table->dropColumn('sender_name'); // Menghapus kolom sender_name
            $table->dropColumn('tracking_number'); // Menghapus kolom tracking_number
            $table->dropIndex(['tracking_number']); // Menghapus indeks pada kolom tracking_number
        });
    }
};
