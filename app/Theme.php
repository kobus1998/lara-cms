<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Theme extends Model
{

  static public function getAllThemes () {
    $storage = Storage::disk('themes')->directories();

    $themes = [];

    foreach ($storage as $theme) {
      $json = json_decode(Storage::disk('themes')->get($theme.'/theme.json'), true);
      $themes[] = $json;
    }

    return $themes;
  }

  static public function getTheme ($slug) {
    return json_decode(Storage::disk('themes')->get($slug.'/theme.json'), true);
  }

  static public function create ($theme) {
    $storage = Storage::disk('themes');
    $slug = strtolower(str_replace(' ', '-', $theme['name']));
    $storage->makeDirectory($slug);
    $storage->put($slug.'/theme.json', json_encode($theme, JSON_PRETTY_PRINT));
    $storage->put($slug.'/style.css', '/* Css code here */');
    $storage->put($slug.'/script.js', '// Javascript code here.');
    $storage->put($slug.'/index.blade.php', '');
    $storage->makeDirectory($slug.'/layouts');
    $storage->put($slug.'/layouts/layout.blade.php', '');
  }
}
