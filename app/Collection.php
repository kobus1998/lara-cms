<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \App\Collection;
use \App\Content;
use \App\Page;

class Collection extends Model
{

  public function posts () {
    return $this->hasMany('\App\Post');
  }

  public function contents () {
    return $this->hasMany('\App\CollectionContent')->orderBy('order');
  }

  static function withContent () {
    return Collection::with(['posts' => function ($q) {
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
    $result = Collection::with('posts')->paginate(15);
    return $result;
  }

  static function getAllWithContent () {
    $result = Collection::with(['posts' => function ($q) {
      $q->with(['content' => function ($q) {
        $q->with('type');
      }]);
    }])->paginate(15);

    return $result;
  }

  static function getCollection ($id) {
    $result = Collection::findOrFail($id)->first();
    return $result;
  }

  static function getCollectionWithContent ($id) {
    $result = Collection::withContent()->with(['contents' => function ($q) {
      $q->with('type');
    }])->where('id', $id)->first();
    return $result;
  }

  static function searchCollection ($q) {
    $result = Collection::with('posts')->where('name', 'LIKE', '%'.$q.'%')->paginate(15);
    return $result;
  }


}
