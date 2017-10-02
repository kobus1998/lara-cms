<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('medias', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('path');
        $table->string('slug');

        $table->string('original_file_name');
        $table->string('original')->nullable();
        $table->string('thumbnail')->nullable();
        $table->string('small')->nullable();
        $table->string('medium')->nullable();

        $table->string('file_type');
        $table->integer('file_size');
        $table->string('file_width')->nullable();
        $table->string('file_height')->nullable();

        $table->string('title')->nullable();
        $table->text('desc')->nullable();
        $table->string('alt')->nullable();
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
      Schema::dropIfExists('medias');
    }
}
