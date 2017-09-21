<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

  public function content () {
    return $this->hasMany('\App\CollectionPost')->orderBy('order');
  }

  public function type () {
    return $this->hasOne('\App\CollectionContent', 'collection_id', 'collection_id')
                ->orderBy('order');
  }

  public function collectionPosts () {
    return $this->hasMany('\App\CollectionPost');
  }

  public function withContent () {
    return $this->with(['content' => function ($q) {
      $q->with('type');
    }]);
  }

  static function getAllPosts () {
    $result = Post::paginate(15)->toArray();

    return $result;
  }

  static function getAllWithContent () {
    $result = Post::with(['content' => function ($q) {
        $q->with('type');
    }])->paginate(15)->toArray();

    return $result;
  }

  static function getPost ($id) {
    $result = Post::findOrFail($id)->get()->toArray();
    $result = reset($result);

    return $result;
  }

  static function getPostWithContent ($id) {
    $result = Post::findOrFail($id)->withContent()->get()->toArray();
    $result = reset($result);

    return $result;
  }

  static function searchCollection ($q) {
    $result = Post::where('name', 'LIKE', '%'.$q.'%')->paginate(15)->toArray();
    return $result;
  }

}
