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
        $table->text('page_desc')->nullable();
        $table->string('slug')->nullable();
        $table->string('url');
        $table->integer('type_id')->unsigned()->nullable();
        $table->text('seo_desc')->nullable();
        $table->string('seo_keywords')->nullable();
        $table->string('seo_title')->nullable();
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
      Schema::dropIfExists('pages');
    }
}
