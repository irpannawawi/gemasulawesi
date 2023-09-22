<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('posts', function(Blueprint $table){
            $table->string('related_articles')->nullable();
            $table->string('tags')->nullable();
            $table->string('topics')->nullable();
            $table->string('schedule_time')->nullable();
            $table->string('published_at')->nullable();
            $table->boolean('is_deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['related_articles', 'tags', 'topics', 'schedule_time', 'published_at', 'is_deleted']);
        });
    }
};
