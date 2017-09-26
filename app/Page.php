<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Page;
use \App\PageContent;

class Page extends Model
{
  public function type () {
    return $this->belongsTo('\App\Type', 'type_id');
  }

  public function content () {
    return $this->hasMany('\App\PageContent')->orderBy('order');
  }
}
