<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('collections')->insert([
        ['name' => 'blog', 'desc' => 'Welcome to my blog!'],
        ['name' => 'portfolio', 'desc' => 'I hope you like my work!']
      ]);

    }
}
