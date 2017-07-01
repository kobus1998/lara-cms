<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
  public function type () {
    return $this->belongsTo('\App\Type');
  }

  public function page () {
    return $this->belongsToMany('\App\Page', 'pages_content', 'content_id', 'page_id');
  }

  public function module () {
    return $this->belongsToMany('\App\Module', 'modules_content', 'content_id', 'module_id');
  }
}
