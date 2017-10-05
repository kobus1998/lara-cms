<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Theme extends Model
{
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
