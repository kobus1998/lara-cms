<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
  public function content() {
    return $this->hasMany('content');
  }
}
