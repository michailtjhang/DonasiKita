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
            // Make bank and amount nullable
            if (Schema::hasColumn('donations', 'amount')) {
                $table->string('amount')->nullable()->change();
            }

            // Add new columns
            if (!Schema::hasColumn('donations', 'sender_name')) {
                $table->string('sender_name')->nullable()->after('bank');
            }
            if (!Schema::hasColumn('donations', 'tracking_number')) {
                $table->string('tracking_number')->nullable()->after('sender_name');
                $table->index('tracking_number');
            }
            if (!Schema::hasColumn('donations', 'description_item')) {
                $table->string('description_item')->nullable()->after('tracking_number');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('donations', function (Blueprint $table) {
            // Revert nullable changes
            if (Schema::hasColumn('donations', 'amount')) {
                $table->string('amount')->change();
            }

            // Drop columns
            if (Schema::hasColumn('donations', 'sender_name')) {
                $table->dropColumn('sender_name');
            }
            if (Schema::hasColumn('donations', 'tracking_number')) {
                $table->dropIndex(['tracking_number']);
                $table->dropColumn('tracking_number');
            }
            if (Schema::hasColumn('donations', 'description_item')) {
                $table->dropColumn('description_item');
            }
        });
    }
};
