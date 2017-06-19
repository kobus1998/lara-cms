<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->foreign('role_id')->references('id')->on('roles');
      });

      Schema::table('pages', function (Blueprint $table) {
        $table->foreign('type_id')->references('id')->on('types');
      });

      Schema::table('content', function (Blueprint $table) {
        $table->foreign('type_id')->references('id')->on('types');
      });

      Schema::table('pages_content', function (Blueprint $table) {
        $table->foreign('page_id')->references('id')->on('pages');
        $table->foreign('content_id')->references('id')->on('content');
      });

      Schema::table('modules_content', function (Blueprint $table) {
        $table->foreign('module_id')->references('id')->on('modules');
        $table->foreign('content_id')->references('id')->on('content');
      });

      Schema::table('page_analytics', function (Blueprint $table) {
        $table->foreign('page_id')->references('id')->on('pages');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
        $table->dropForeign('roles_role_id_foreign');
      });

      Schema::table('pages', function (Blueprint $table) {
        $table->dropForeign('types_type_id_foreign');
      });

      Schema::table('content', function (Blueprint $table) {
        $table->dropForeign('types_type_id_foreign');
      });

      Schema::table('pages_content', function (Blueprint $table) {
        $table->dropForeign('pages_page_id_foreign');
        $table->dropForeign('content_content_id_foreign');
      });

      Schema::table('modules_content', function (Blueprint $table) {
        $table->dropForeign('modules_module_id_foreign');
        $table->dropForeign('content_content_id_foreign');
      });

      Schema::table('page_analytics', function (Blueprint $table) {
        $table->dropForeign('pages_page_id_foreign');
      });
    }
}
