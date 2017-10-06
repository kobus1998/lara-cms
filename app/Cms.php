<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Config;

class Cms extends Model
{
  static public function setTheme ($name) {
    $settings = Storage::disk('themes')->get('settings.json');
    $settings = json_decode($settings, true);
    $settings['theme'] = $name;
    $settings = json_encode($settings, JSON_PRETTY_PRINT);
    Storage::disk('themes')->put('settings.json', $settings);
  }

  static public function getThemeName () {
    $settings = Storage::disk('themes')->get('settings.json');
    $settings = json_decode($settings, true);
    return $settings['theme'];
  }

}
