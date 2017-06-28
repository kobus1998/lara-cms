<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{

  protected $table = 'pages_content';

  public function page () {
    return $this->belongsToMany();
  }

  public function content () {
    return $this->belongsTo('\App\Content');
  }

}
