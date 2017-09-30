<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepeatingContent extends Model
{

  protected $table = 'repeatable_content';

  public function repeatable () {
    return $this->morphTo();
  }

}
