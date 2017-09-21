<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('pages')->insert([
        [
          'name' => 'home',
          'desc' => 'home',
          'url' => 'home'
        ],
        [
          'name' => 'about',
          'desc' => 'about',
          'url' => 'about'
        ],
        [
          'name' => 'portfolio',
          'desc' => 'portfolio',
          'url' => 'portfolio'
        ],
        [
          'name' => 'blog',
          'desc' => 'blog',
          'url' => 'blog'
        ]
      ]);

    }
}
