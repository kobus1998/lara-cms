<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $contents = [
        [ 'name' => 'title', 'type_id' => 1 ],
        [ 'name' => 'content', 'type_id' => 2 ],
        [ 'name' => 'image', 'type_id' => 3 ],
      ];

      DB::table('contents')->insert($contents);

    }
}
