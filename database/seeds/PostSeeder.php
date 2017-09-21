<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('posts')->insert([
        ['name' => 'blog post', 'collection_id' => 1],
        ['name' => 'blog post 2', 'collection_id' => 1],
        ['name' => 'portfolio 1', 'collection_id' => 2],
        ['name' => 'portfolio 2', 'collection_id' => 2]
      ]);
    }
}
