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

      Schema::table('modules', function (Blueprint $table) {
        $table->foreign('type_id')->references('id')->on('types');
      });

      Schema::table('contents', function (Blueprint $table) {
        $table->foreign('type_id')->references('id')->on('types');
      });

      Schema::table('pages_content', function (Blueprint $table) {
        $table->foreign('page_id')->references('id')->on('pages');
        $table->foreign('content_id')->references('id')->on('contents');
      });

      Schema::table('modules_content', function (Blueprint $table) {
        $table->foreign('module_id')->references('id')->on('modules');
        $table->foreign('content_id')->references('id')->on('contents');
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
        $table->dropForeign('users_role_id_foreign');
      });

      Schema::table('pages', function (Blueprint $table) {
        $table->dropForeign('pages_type_id_foreign');
      });

      Schema::table('modules', function (Blueprint $table) {
        $table->dropForeign('modules_type_id_foreign');
      });

      Schema::table('contents', function (Blueprint $table) {
        $table->dropForeign('contents_type_id_foreign');
      });

      Schema::table('pages_content', function (Blueprint $table) {
        $table->dropForeign('pages_content_page_id_foreign');
        $table->dropForeign('pages_content_content_id_foreign');
      });

      Schema::table('modules_content', function (Blueprint $table) {
        $table->dropForeign('modules_content_module_id_foreign');
        $table->dropForeign('modules_content_content_id_foreign');
      });

      Schema::table('page_analytics', function (Blueprint $table) {
        $table->dropForeign('page_analytics_page_id_foreign');
      });
    }
}
