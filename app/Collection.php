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
    return $this->hasMany('\App\CollectionContent');
  }

  public function withContent () {
    return $this->with(['posts' => function ($q) {
      $q->with(['content' => function ($q) {
        $q->with('type');
      }]);
    }]);
  }

  static function getAllCollections () {
    $result = Collection::paginate(15)->toArray();

    return $result;
  }

  static function getAllWithContent () {
    $result = Collection::with(['posts' => function ($q) {
      $q->with(['content' => function ($q) {
        $q->with('type');
      }]);
    }])->paginate(15)->toArray();

    return $result;
  }

  static function getCollection ($id) {
    $result = Collection::findOrFail($id)->get()->toArray();
    $result = reset($result);

    return $result;
  }

  static function getCollectionWithContent ($id) {
    $result = Collection::findOrFail($id)->withContent()->get()->toArray();
    $result = reset($result);

    return $result;
  }

  static function searchCollection ($q) {
    $result = Collection::where('name', 'LIKE', '%'.$q.'%')->paginate(15)->toArray();
    return $result;
  }


}
