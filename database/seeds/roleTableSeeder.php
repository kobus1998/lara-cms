<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roleTableSeeder extends Seeder
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
          'name' => 'admin',
          'desc' => 'Has access to everything.',
          'priority' => 1
        ], [
          'name' => 'moderator',
          'desc' => 'Moderates the other users.',
          'priority' => 2
        ], [
          'name' => 'writer',
          'desc' => 'Only has access to the content.',
          'priority' => 3
        ]
      ];

      DB::table('roles')->insert($roles);

    }
}
