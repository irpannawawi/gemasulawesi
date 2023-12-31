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
        Schema::create('images', function (Blueprint $table) {
            $table->bigIncrements('image_id')->primary;
            $table->bigInteger('asset_id')->unsigned();
            $table->bigInteger('uploader_id')->unsigned();
            $table->foreign('asset_id')
                    ->references('asset_id')
                    ->on('assets');
                    
            $table->foreign('uploader_id')
            ->references('id')
            ->on('users');
            $table->string('author', 155)->nullable();
            $table->text('caption')->nullable();
            $table->string('credit', 255)->nullable();
            $table->string('source', 255)->nullable();
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
        Schema::dropIfExists('images');
    }
};
