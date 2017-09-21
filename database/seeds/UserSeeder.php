<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('users')->insert([
        [
          'name' => 'admin',
          'email' => 'dev.kobus@gmail.com',
          'role_id' => 1,
          'password' => bcrypt('password')
        ],
        [
          'name' => 'moderator',
          'email' => 'me@kobus.xyz',
          'role_id' => 2,
          'password' => bcrypt('password')
        ],
        [
          'name' => 'writer',
          'email' => 'write@me.nl',
          'role_id' => 3,
          'password' => bcrypt('password')
        ]
      ]);

    }
}
