<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('collections_content')->insert([
        ['collection_id' => 1, 'type_id' => 1, 'name' => 'title', 'repeatable' => 0],
        ['collection_id' => 1, 'type_id' => 1, 'name' => 'gallery', 'repeatable' => 1],
        ['collection_id' => 1, 'type_id' => 2, 'name' => 'content', 'repeatable' => 0],
        ['collection_id' => 2, 'type_id' => 1, 'name' => 'title', 'repeatable' => 0],
        ['collection_id' => 2, 'type_id' => 2, 'name' => 'content', 'repeatable' => 0],
        ['collection_id' => 2, 'type_id' => 3, 'name' => 'image', 'repeatable' => 0]
      ]);
    }
}
