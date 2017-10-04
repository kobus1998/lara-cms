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

  public function addRepeatingContent (Request $req, $id) {
    $repeatingContent = new \App\RepeatingContent;
    $repeatingContent->repeatable_id = $id;
    $repeatingContent->repeatable_type = 'App\CollectionPost';
    $repeatingContent->save();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($repeatingContent);
    }
  }

  public function deleteRepeatingContent (Request $req, $id) {
    $repeatingContent = \App\RepeatingContent::destroy($id);
    // $repeatingContent->remove();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($repeatingContent);
    }
  }

  public function updateContent (Request $req, $id) {

    // dd($req->request);

    foreach ($req->items as $item) {
      if ($item['is-repeatable'] == 1) {
        foreach ($item['repeatable'] as $repeatable) {
          $rep = \App\RepeatingContent::where('id', '=', $repeatable['id']);
          $rep->update([
            'order' => $repeatable['order'],
            'content' => $repeatable['content']
          ]);
        }
      } else {
        $content = \App\CollectionPost::where('id', '=', $item['id']);
        $content->update([
          'content' => $item['content']
        ]);
      }
    }

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json();
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
