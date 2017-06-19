<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use \App\User as User;

class userTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      $countRoles = \App\Role::count();

      for ($i = 1; $i <= 20; $i++) {

        $user = [
          'name' => $faker->name(),
          'email' => $faker->email(),
          'role_id' => rand(1, $countRoles),
          'password' => bcrypt('password')
        ];

        User::create($user);
      }


    }
}
