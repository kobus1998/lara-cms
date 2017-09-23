<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  public function type () {
    return $this->belongsTo('\App\Type');
  }

  public function page () {
    return $this->belongsToMany('\App\Page', 'contents_pages', 'content_id', 'page_id')
                ->withPivot('id', 'order', 'body')->orderBy('order', 'asc');
  }

  public function collection () {
    return $this->belongsToMany('\App\Collection', 'collections_contents', 'content_id', 'collection_id');
  }

  public function group () {
    return $this->belongsToMany('\App\ContentGroup', 'contents_content_groups', 'content_id', 'content_group_id');
  }

  public function contents_posts() {
    return $this->belongsToMany('\App\ContentPosts');
  }
}
