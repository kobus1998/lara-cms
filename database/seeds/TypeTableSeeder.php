<?php

use Illuminate\Database\Seeder;
use \App\Type as Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = [
        [
          'name' => 'page',
        ], [
          'name' => 'module',
        ], [
          'name' => 'partial',
        ],
      ];

      foreach ($roles as $index) {
        Type::insert($index);
      }
    }
}
