<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;
use \App\CollectionPost;

class PostController extends Controller
{
  public function store (Request $req) {

    // dd($req);

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


  }
}
