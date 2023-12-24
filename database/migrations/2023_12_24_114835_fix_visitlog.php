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
        Schema::table('visitlogs', function (Blueprint $table) {
            $table->index(['id', 'ip','page', 'created_at','updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('visitlogs', function (Blueprint $table) {
            $table->dropIndex(['id', 'ip','page', 'created_at','updated_at']);

        });
    }
};
