<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(roleTableSeeder::class);
      $this->call(TypeTableSeeder::class);
      $this->call(UserSeeder::class);
      $this->call(PageSeeder::class);
      $this->call(PagesContentSeeder::class);
      $this->call(CollectionSeeder::class);
      $this->call(PostSeeder::class);
      $this->call(CollectionPageSeeder::class);
      $this->call(CollectionContentSeeder::class);
      $this->call(CollectionContentPostSeeder::class);
      $this->call(RepeatableContentSeeder::class);
    }
}
