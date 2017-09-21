<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pages', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->text('desc')->nullable();
        $table->string('url');
        $table->string('layout')->default('index');
        $table->text('seo_desc')->nullable();
        $table->string('seo_keywords')->nullable();
        $table->string('seo_title')->nullable();
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
      Schema::dropIfExists('pages');
    }
}
