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
      DB::table('collections_contents')->insert(
        ['collection_id' => 1, 'type_id' => 1],
        ['collection_id' => 1, 'type_id' => 2]
      );
    }
}
