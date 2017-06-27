<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
  public function type () {
    return $this->belongsTo('type');
  }

  public function page () {
    return $this->belongsTo('\App\Page');
  }
}
