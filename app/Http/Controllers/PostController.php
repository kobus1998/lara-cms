<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Post;
use \App\CollectionPost;

class PostController extends Controller
{
  public function store (Request $req) {
    $post = new Post();

    $this->validate($req, [
      'name' => 'required',
      'collection-id' => 'required'
    ]);

    $post['name'] = $req['name'];
    $post['collection_id'] = $req['collection-id'];
    $post->save();

    // dd($req->request);
    foreach ($req['content-id'] as $key => $val) {
      $collectionPost = new CollectionPost();
      $collectionPost['post_id'] = $post['id'];
      $collectionPost['collection_content_id'] = $val;
      $collectionPost['order'] = $req['order'][$key];
      $collectionPost['content'] = $req['post-content'][$key];
      $collectionPost->save();
    }

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($post);
    }
  }

  public function update (Request $req, $id) {

    $this->validate($req,[
      'name' => 'required'
    ]);

    $post = Post::find($id);
    $post->name = $req['name'];

    $post->save();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($post);
    }
  }

  public function updateContent (Request $req, $id) {
    $result = [];
    foreach ($req['content-id'] as $key => $value) {
      $collectionPost = \App\CollectionPost::find($value);
      $collectionPost->content = $req['content'][$key];
      $collectionPost->save();
      $result[][$value] = $collectionPost;
    }

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($result);
    }
  }

  public function setInactiveMultiple (Request $req) {
    $post = Post::whereIn('id', $req->ids);
    $post->update(['is_active' => 0]);

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($post);
    }
  }

  public function deleteMultiple (Request $req) {
    $post = Post::findMany($req->ids)->toArray();
    DB::table('posts')->whereIn('id', $req->ids)->delete();
    DB::table('collections_contents_posts')->whereIn('post_id', $req->ids)->delete();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($post);
    }
  }

}
