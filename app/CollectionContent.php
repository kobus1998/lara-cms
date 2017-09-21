<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionContent extends Model
{

  protected $table = 'collections_contents';

  public function content () {
    return $this->hasMany('\App\CollectionPost', 'collection_content_id', 'id');
  }

  public function type () {
    return $this->belongsTo('\App\Type');
  }

}
