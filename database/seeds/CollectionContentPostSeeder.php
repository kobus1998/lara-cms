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
      DB::table('collections_contents_posts')->insert(
        ['post_id' => 1, 'collection_content_id' => 1]
      );
    }
}
