<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('types', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name');
        $table->enum('purpose', ['content', 'page', 'module', 'all']);
        $table->text('desc')->nullable();
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
      Schema::dropIfExists('types');
    }
}
