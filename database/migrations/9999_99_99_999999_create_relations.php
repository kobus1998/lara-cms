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

      Schema::table('pages', function (Blueprint $table) {
        $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('contents', function (Blueprint $table) {
        $table->foreign('type_id')
              ->references('id')
              ->on('types')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('contents_pages', function (Blueprint $table) {
        $table->foreign('page_id')
              ->references('id')
              ->on('pages')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('content_id')
              ->references('id')
              ->on('contents')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('page_analytics', function (Blueprint $table) {
        $table->foreign('page_id')
              ->references('id')
              ->on('pages')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('contents_content_groups', function (Blueprint $table) {
        $table->foreign('content_id')
              ->references('id')
              ->on('contents')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('content_group_id')
              ->references('id')
              ->on('content_groups')
              ->onDelete('cascade')
              ->onUpdate('cascade');
      });

      Schema::table('content_groups_pages', function (Blueprint $table) {
        $table->foreign('page_id')
              ->references('id')
              ->on('pages')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('content_group_id')
              ->references('id')
              ->on('content_groups')
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

      Schema::table('collections_contents', function (Blueprint $table) {
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

      Schema::table('collections_contents_posts', function (Blueprint $table) {
        $table->foreign('post_id')
              ->references('id')
              ->on('posts')
              ->onDelete('cascade')
              ->onUpdate('cascade');

        $table->foreign('collection_content_id')
              ->references('id')
              ->on('collections_contents')
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

      Schema::table('pages', function (Blueprint $table) {
        $table->dropForeign('pages_type_id_foreign');
      });

      Schema::table('contents', function (Blueprint $table) {
        $table->dropForeign('contents_type_id_foreign');
      });

      Schema::table('pages_contents', function (Blueprint $table) {
        $table->dropForeign('pages_contents_page_id_foreign');
        $table->dropForeign('pages_contents_content_id_foreign');
      });

      Schema::table('page_analytics', function (Blueprint $table) {
        $table->dropForeign('page_analytics_page_id_foreign');
      });

      Schema::table('contents_content_groups', function (Blueprint $table) {
        $table->dropForeign('contents_content_groups_content_group_id_foreign');
        $table->dropForeign('contents_content_groups_content_id_foreign');
      });

      Schema::table('content_groups_pages', function (Blueprint $table) {
        $table->dropForeign('content_groups_pages_contents_group_id_foreign');
        $table->dropForeign('content_groups_pages_page_id_foreign');
      });

      Schema::table('collections_pages', function (Blueprint $table) {
        $table->dropForeign('collections_pages_collection_id_foreign');
        $table->dropForeign('collections_pages_page_id_foreign');
      });

      Schema::table('collections_contents', function (Blueprint $table) {
        $table->dropForeign('collections_contents_collection_id_foreign');
        $table->dropForeign('collections_contents_type_id_foreign');
      });

      Schema::table('collections_contents_posts', function (Blueprint $table) {
        $table->dropForeign('collections_contents_posts_collection_content_id_foreign');
        $table->dropForeign('collections_contents_posts_post_id_foreign');
      });

      Schema::table('posts', function (Blueprint $table) {
        $table->dropForeign('posts_collection_id_foreign');
      });

    }
}
