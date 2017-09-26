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
    $result = Collection::where('is_active', '=', 1)->with('posts')->paginate(15);
    return $result;
  }

  static function getAllWithContent () {
    $result = Collection::where('is_active', '=', 1)->with(['posts' => function ($q) {
      $q->with(['content' => function ($q) {
        $q->with('type');
      }]);
    }])->paginate(15);

    return $result;
  }

  static function getCollection ($id) {
    $result = Collection::findOrFail($id)->where('is_active', '=', 1)->first();
    return $result;
  }

  static function getCollectionWithContent ($id) {
    $result = Collection::withContent()->where('is_active', '=', 1)->with(['contents' => function ($q) {
      $q->with('type');
    }])->where('id', $id)->first();
    return $result;
  }

  static function searchCollection ($q) {
    $result = Collection::with('posts')->where('name', 'LIKE', '%'.$q.'%')->where('is_active', '=', 1)->paginate(15);
    return $result;
  }


}
