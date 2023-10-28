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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('post_id')->primary;
            $table->string('title');
            $table->string('slug');
            $table->string('category');
            $table->text('description');
            $table->text('article');
            $table->boolean('allow_comment')->nullable()->default(false);
            $table->boolean('view_in_welcome_page')->nullable()->default(false);
            $table->bigInteger('author_id')->unsigned();
            $table->bigInteger('editor_id')->unsigned();
            $table->enum('status', ['draft', 'published', 'scheduled', 'trash']);
            $table->index(['slug', 'category']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
