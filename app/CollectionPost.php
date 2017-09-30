<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CollectionPost extends Model
{
  protected $table = 'collections_content_posts';

  public function type () {
    $result = $this->belongsTo('\App\CollectionContent', 'collection_content_id', 'id')->with('type');
    return $result;
  }

  public function repeatingContent () {
    return $this->morphMany('\App\RepeatingContent', 'repeatable');
  }

}
