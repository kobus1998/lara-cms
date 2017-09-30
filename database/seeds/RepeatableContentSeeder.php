<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RepeatableContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('repeatable_content')->insert([
        ['repeatable_id' => 1, 'repeatable_type' => 'App\CollectionPost'],
        ['repeatable_id' => 2, 'repeatable_type' => 'App\CollectionPost'],
        ['repeatable_id' => 3, 'repeatable_type' => 'App\CollectionPost'],
      ]);
    }
}
