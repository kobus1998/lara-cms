<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  public function content () {
    return $this->hasMany('\App\Content', 'page_content');
  }

  public function type () {
    return $this->belongsTo('\App\Type', 'type_id');
  }
}
