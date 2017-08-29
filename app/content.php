<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class content extends Model
{
  public function type () {
    return $this->belongsTo('\App\Type');
  }

  public function page () {
    return $this->belongsToMany('\App\Page', 'pages_content', 'content_id', 'page_id')
                ->withPivot('id', 'order', 'body')->orderBy('order', 'asc');
  }

  public function module () {
    return $this->belongsToMany('\App\Module', 'modules_content', 'content_id', 'module_id');
  }

  public function group () {
    return $this->belongsToMany('\App\ContentGroup', 'contents_content_groups', 'content_id', 'content_group_id');
  }
}
