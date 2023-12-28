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
        Schema::create('x_auths', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('nickname');
            $table->string('name');
            $table->json('user');
            $table->json('attributes');
            $table->text('token');
            $table->text('token_secret');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('x_auths');
    }
};
