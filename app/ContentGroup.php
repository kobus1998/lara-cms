<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentGroup extends Model
{
  public function content () {
    return $this->belongsToMany('\App\Content', 'contents_content_groups', 'content_group_id', 'content_id');
  }

  public function page () {
    return $this->belongsToMany('\App\Page', 'content_groups_pages', 'content_group_id', 'page_id');  
  }
}
