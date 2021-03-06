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
        ['post_id' => 1, 'collection_content_id' => 1, 'repeatable' => 0],
        ['post_id' => 1, 'collection_content_id' => 2, 'repeatable' => 1],
        ['post_id' => 1, 'collection_content_id' => 3, 'repeatable' => 0],

        ['post_id' => 2, 'collection_content_id' => 1, 'repeatable' => 0],
        ['post_id' => 2, 'collection_content_id' => 2, 'repeatable' => 0],
        ['post_id' => 2, 'collection_content_id' => 3, 'repeatable' => 0],

        ['post_id' => 3, 'collection_content_id' => 3, 'repeatable' => 0],
        ['post_id' => 3, 'collection_content_id' => 4, 'repeatable' => 0],
        ['post_id' => 3, 'collection_content_id' => 5, 'repeatable' => 0],

        ['post_id' => 4, 'collection_content_id' => 3, 'repeatable' => 0],
        ['post_id' => 4, 'collection_content_id' => 4, 'repeatable' => 0],
        ['post_id' => 4, 'collection_content_id' => 5, 'repeatable' => 0]
      ]);
    }
}
