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
        Schema::create('fb_pages', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->text('access_token');
            $table->string('name');
            $table->string('category');
            $table->json('category_list');
            $table->json('tasks');
            $table->text('page_avatar');
            $table->bigInteger('instagram_business_id');
            $table->bigInteger('instagram_id');
            $table->string('instagram_username');
            $table->text('instagram_profile_pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fb_pages');
    }
};
