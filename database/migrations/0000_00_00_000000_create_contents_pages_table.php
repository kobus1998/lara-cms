<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contents_pages', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('page_id')->unsigned();
        $table->integer('content_id')->unsigned();
        $table->string('body')->nullable();
        $table->integer('order')->default(0);
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
      Schema::dropIfExists('contents_pages');
    }
}
