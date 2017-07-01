<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contents', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->string('title')->nullable();
        $table->text('body');
        $table->integer('type_id')->unsigned();
        $table->boolean('is_active')->default(true);
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
      Schema::dropIfExists('contents');
    }
}
