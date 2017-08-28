<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  public function content () {
    return $this->belongsToMany('\App\Content', 'pages_content', 'page_id', 'content_id')
                ->withPivot('id', 'order', 'body');
  }

  public function type () {
    return $this->belongsTo('\App\Type', 'type_id');
  }
}
