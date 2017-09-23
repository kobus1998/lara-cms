<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
  public function content () {
    return $this->belongsToMany('\App\Content', 'contents_pages', 'page_id', 'content_id')
                ->withPivot('id', 'order', 'body')->orderBy('order', 'asc');
  }

  public function contentGroup () {
    return $this->belongsToMany('\App\contentGroup', 'content_groups_pages', 'page_id', 'content_group_id')
                ->withPivot('id', 'page_id', 'content_group_id');
  }

  public function type () {
    return $this->belongsTo('\App\Type', 'type_id');
  }
}
