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
        Schema::create('linkedin_auths', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('avatar')->nullable();
            $table->json('user')->nullable();
            $table->json('attributes')->nullable();
            $table->text('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('linkedin_auths');
    }
};
