<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CollectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('collections', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->text('desc')->nullable();
        $table->boolean('all_pages')->default(false);
        $table->boolean('is_active')->default(1);
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
      Schema::dropIfExists('collections');
    }
}
