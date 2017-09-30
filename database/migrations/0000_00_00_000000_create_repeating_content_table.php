<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepeatingContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('repeatable_content', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('repeatable_id')->unsigned();
        $table->string('repeatable_type');
        $table->text('content')->nullable();
        $table->boolean('order')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('repeatable_content');
    }
}
