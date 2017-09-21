<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContentsContentsGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('contents_content_groups', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('content_id')->unsigned();
        $table->integer('content_group_id')->unsigned();
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
      Schema::dropIfExists('contents_content_groups');
    }
}
