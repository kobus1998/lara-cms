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
      $types = [
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
        ], [
          'name' => 'page',
          'desc' => 'A normal page, can be used for the home page.',
          'purpose' => 'page'
        ], [
          'name' => 'module',
          'desc' => 'A module.',
          'purpose' => 'module'
        ], [
          'name' => 'blog',
          'desc' =>  'A page for your blog post. For instance: blog/1 to get your first blog post.',
          'purpose' => 'page'
        ], [
          'name' => 'blog-item',
          'desc' => 'A blog post for your blog.',
          'purpose' => 'content'
        ]
      ];

      foreach ($types as $type) {
        Type::insert($type);
      }
    }
}
