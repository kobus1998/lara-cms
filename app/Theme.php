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
    $storage->makeDirectory($theme['name']);
    $storage->put($theme['name'].'/theme.json', json_encode($theme, JSON_PRETTY_PRINT));
    $storage->put($theme['name'].'/style.css', '/* Css code here */');
    $storage->put($theme['name'].'/script.js', '// Javascript code here.');
    $storage->put($theme['name'].'/index.blade.php', '');
    $storage->makeDirectory($theme['name'].'/layouts');
    $storage->put($theme['name'].'/layouts/layout.blade.php', '');
  }
}
