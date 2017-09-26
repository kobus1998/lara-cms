<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollectionsContentsPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('collections_contents_posts', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('post_id')->unsigned();
        $table->integer('collection_content_id')->unsigned();
        $table->text('content')->nullable();
        $table->integer('order')->default();
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
      Schema::dropIfExists('collections_contents_posts');
    }
}
