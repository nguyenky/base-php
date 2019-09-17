<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id');
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('description')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();

            $table->foreign('channel_id', 'images_fk_channel_id_1')
                ->references('id')
                ->on('channels')
                ->onUpdate('restrict')
                ->onDelete('cascade');
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
}
