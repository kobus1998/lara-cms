<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('collections_content', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('collection_id')->unsigned();
        $table->string('name');
        $table->integer('type_id')->unsigned();
        $table->boolean('repeatable')->default(0);
        $table->boolean('order')->default(0)->nullable();
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('collections_content');
    }
}
