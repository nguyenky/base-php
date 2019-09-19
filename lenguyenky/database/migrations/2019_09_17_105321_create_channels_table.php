<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->string('category')->nullable();
            $table->string('copyright')->nullable();
            $table->string('docs')->nullable();
            $table->string('language')->nullable();
            $table->datetime('lastBuildDate')->nullable();
            $table->string('managingEditor')->nullable();
            $table->datetime('pub_date')->nullable();
            $table->string('webMaster')->nullable();
            $table->string('generator')->nullable();
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
        Schema::dropIfExists('channels');
    }
}
