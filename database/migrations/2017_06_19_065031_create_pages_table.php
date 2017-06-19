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
          $table->string('page_name');
          $table->text('page_desc');
          $table->string('slug');
          $table->string('url');
          $table->integer('type_id')->unsigned();
          $table->text('seo_desc');
          $table->string('seo_keywords');
          $table->string('seo_title');
          $table->boolean('is_active');
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
