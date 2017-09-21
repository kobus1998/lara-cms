<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      DB::table('types')->insert([
        [
          'name' => 'textfield',
          'desc' => 'A textfield for words or a single sentence.',
          'purpose' => 'content'
        ], [
          'name' => 'textarea',
          'desc' => 'A textarea for a whole lot of text.',
          'purpose' => 'content'
        ], [
          'name' => 'media',
          'desc' => 'A file or photo.',
          'purpose' => 'content',
        ], [
          'name' => 'checkbox',
          'desc' => 'A checkbox to let a user turn something on and off.',
          'purpose' => 'content'
        ]
      ]);

    }
}
