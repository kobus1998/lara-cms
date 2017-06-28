<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
  public function type () {
    return $this->belongsTo('type');
  }

  public function page () {
    return $this->belongsToMany('\App\Page', 'pages_content', 'content_id', 'page_id');
  }
}
