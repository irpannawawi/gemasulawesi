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
        
        Schema::table('posts', function (Blueprint $table) {
            $table->index(['post_id']);
            $table->index(['title']);
            $table->index(['post_image']);
            $table->index(['status']);
            $table->index(['tags', 'topics', 'related_articles']);
            $table->index(['published_at', 'author_id', 'editor_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function(Blueprint $table){
            $table->dropIndex(['post_id']);
            $table->dropIndex(['title']);
            $table->dropIndex(['post_image']);
            $table->dropIndex(['status']);
            $table->dropIndex(['tags', 'topics', 'related_articles']);
            $table->dropIndex(['published_at', 'author_id', 'editor_id']);
        });
    }
};
