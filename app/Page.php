<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{


  public function content () {
    return $this->hasMany('\App\PageContent');
  }

  public function type () {
    return $this->belongsTo('\App\Type', 'type_id');
  }
}
