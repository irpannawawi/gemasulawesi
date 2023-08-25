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
            $table->increments('image_id')->primary;
            $table->integer('asset_id')->unsigned();
            $table->bigInteger('uploader_id')->unsigned();
            $table->foreign('asset_id')
                    ->references('asset_id')
                    ->on('assets');
                    
            $table->foreign('uploader_id')
            ->references('id')
            ->on('users');
            $table->string('author', 155);
            $table->text('caption');
            $table->string('credit', 255);
            $table->string('source', 255);
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
