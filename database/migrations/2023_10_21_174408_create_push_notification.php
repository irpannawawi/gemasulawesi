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
        Schema::create('push_notification', function (Blueprint $table) {
            $table->bigIncrements('notif_id')->primary;
            $table->bigInteger('post_id');
            $table->string('title');
            $table->text('body');
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['sent', 'queue']);
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
        Schema::dropIfExists('push_notification');
    }
};
