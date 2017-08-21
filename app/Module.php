<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
  public function content () {
    return $this->belongsToMany('\App\Content', 'modules_content', 'module_id', 'content_id');
  }

  public function type () {
    return $this->belongsTo('\App\Type', 'type_id');
  }
}
