<?php

use Illuminate\Database\Seeder;

class PagesContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pages_content')->insert([
        ['page_id' => 1, 'type_id' => 1, 'name' => 'Title', 'order' => 0],
        ['page_id' => 1, 'type_id' => 2, 'name' => 'Content', 'order' => 1],

        ['page_id' => 2, 'type_id' => 1, 'name' => 'Title', 'order' => 0],
        ['page_id' => 2, 'type_id' => 2, 'name' => 'Content', 'order' => 1],

        ['page_id' => 3, 'type_id' => 1, 'name' => 'Title', 'order' => 0],
        ['page_id' => 3, 'type_id' => 2, 'name' => 'Content', 'order' => 1],

        ['page_id' => 4, 'type_id' => 1, 'name' => 'Title', 'order' => 0],
        ['page_id' => 4, 'type_id' => 2, 'name' => 'Content', 'order' => 1],
      ]);
    }
}
