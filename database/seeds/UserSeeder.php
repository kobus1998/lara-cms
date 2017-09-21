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

      DB::table('users')->insert(
        [
          'name' => 'admin',
          'email' => 'me@kobus.xyz',
          'role_id' => 1,
          'password' => bcrypt('password')
        ]
      );

    }
}
