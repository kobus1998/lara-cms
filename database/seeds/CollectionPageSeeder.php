<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('collections_pages')->insert(
        ['collection_id' => 1, 'page_id' => 1]
      );
    }
}
