<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \App\Collection;
use \App\Page;

class Collection extends Model
{

  public function posts () {
    return $this->hasMany('\App\Post');
  }

  public function contents () {
    return $this->hasMany('\App\CollectionContent')->orderBy('order');
  }

  public function repeatingContent () {
    return $this->morphMany('\App\RepeatingContent', 'refers');
  }

  static function getPosts ($id) {
    return Post::where('collection_id', '=', $id)->where('is_active', '=', 1);
  }

  static function withContent () {
    return Collection::where('is_active', '=', 1)->with(['posts' => function ($q) {

      $q->with(['content' => function ($q) {
        $q->with('type');
      }]);
    }]);
  }

  public function countPosts () {
    return $this->with(['posts' => function ($q) {
      $q->count();
    }]);
  }

  static function getAllCollections () {
    return Collection::where('is_active', '=', 1)->with('posts')->paginate(15);
  }

  static function getAllWithContent () {
    return Collection::where('is_active', '=', 1)->with(['posts' => function ($q) {
      $q->with(['content' => function ($q) {
        $q->with('type');
      }]);
    }])->paginate(15);
  }

  static function getCollection ($id) {
    return Collection::findOrFail($id)->where('is_active', '=', 1)->first();
  }

  static function getCollectionWithContent ($id) {
    return Collection::withContent()->where('is_active', '=', 1)->with(['contents' => function ($q) {
      $q->with('type');
    }])->where('id', $id)->first();
  }

  static function searchCollection ($q) {
    return Collection::with('posts')->where('name', 'LIKE', '%'.$q.'%')->where('is_active', '=', 1)->paginate(15);
  }

  static function getPostWithContent ($id) {
    return \App\Post::where('id', $id)->where('is_active', '=', 1)->with(['content' => function ($q) {
      $q->with('type');
    }])->first();
  }


}
