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
        $table->integer('page_id')->unsigned();
        $table->string('name');
        $table->integer('type_id')->unsigned();
        $table->boolean('order')->default(0)->nullable();
        $table->text('content')->nullable();
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
