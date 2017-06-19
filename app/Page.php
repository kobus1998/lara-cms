<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  public function content () {
    return $this->hasMany('content', 'page_content');
  }
}
