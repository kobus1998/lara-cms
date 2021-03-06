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
        $table->foreign('role_id')
              ->references('id')
              ->on('roles')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('collections_pages', function (Blueprint $table) {
        $table->foreign('collection_id')
              ->references('id')
              ->on('collections')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('page_id')
              ->references('id')
              ->on('pages')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('collections_content', function (Blueprint $table) {
        $table->foreign('collection_id')
              ->references('id')
              ->on('collections')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('posts', function (Blueprint $table) {
        $table->foreign('collection_id')
              ->references('id')
              ->on('collections')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('collections_content_posts', function (Blueprint $table) {
        $table->foreign('post_id')
              ->references('id')
              ->on('posts')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('collection_content_id')
              ->references('id')
              ->on('collections_content')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('pages_content', function (Blueprint $table) {
        $table->foreign('page_id')
              ->references('id')
              ->on('pages')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade')
              ->onUpdate('cascade');
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

      Schema::table('collections_pages', function (Blueprint $table) {
        $table->dropForeign('collections_pages_collection_id_foreign');
        $table->dropForeign('collections_pages_page_id_foreign');
      });

      Schema::table('collections_content', function (Blueprint $table) {
        $table->dropForeign('collections_content_collection_id_foreign');
        $table->dropForeign('collections_content_type_id_foreign');
      });

      Schema::table('collections_content_posts', function (Blueprint $table) {
        $table->dropForeign('collections_content_posts_collection_content_id_foreign');
        $table->dropForeign('collections_content_posts_post_id_foreign');
      });

      Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign('posts_collection_id_foreign');
      });

      Schema::table('pages_content', function (Blueprint $table) {
        $table->dropForeign('pages_content_page_id_foreign');
        $table->dropForeign('pages_content_type_id_foreign');
      });

    }
}
