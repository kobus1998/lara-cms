<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Type;

class PageContent extends Model
{
  protected $table = 'pages_content';
  public $timestamps = false;

  public function type () {
    return $this->belongsTo('\App\Type');
  }

  public function repeatingContent () {
    return $this->morphMany('\App\RepeatingContent', 'repeatable')->orderBy('order');
  }

}
