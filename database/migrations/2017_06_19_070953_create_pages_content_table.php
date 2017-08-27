<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pages_content', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('order')->default(0);
        $table->string('body')->nullable();
        $table->integer('page_id')->unsigned();
        $table->integer('content_id')->unsigned();
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
      Schema::dropIfExists('pages_content');
    }
}
