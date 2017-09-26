<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionContentPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('collections_content_posts')->insert([
        ['post_id' => 1, 'collection_content_id' => 1],
        ['post_id' => 1, 'collection_content_id' => 2],

        ['post_id' => 2, 'collection_content_id' => 1],
        ['post_id' => 2, 'collection_content_id' => 2],

        ['post_id' => 3, 'collection_content_id' => 3],
        ['post_id' => 3, 'collection_content_id' => 4],
        ['post_id' => 3, 'collection_content_id' => 5],

        ['post_id' => 4, 'collection_content_id' => 3],
        ['post_id' => 4, 'collection_content_id' => 4],
        ['post_id' => 4, 'collection_content_id' => 5]
      ]);
    }
}
