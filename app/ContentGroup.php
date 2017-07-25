<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentGroup extends Model
{
  public function content () {
    return $this->belongsToMany('\App\Content', 'contents_content_groups', 'content_group_id', 'content_id');
  }
}
