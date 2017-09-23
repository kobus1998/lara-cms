<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Collection;
use \App\Content;
use \App\Page;

class CollectionController extends Controller
{

  public function index (Request $req) {
    $searchQuery = app('request')->input('s');

    if (count($searchQuery) > 0) {
      $collections = Collection::searchCollection($searchQuery);
    } else {
      $collections = Collection::getAllCollections();
    }


    return view('dashboard/collections/index', ['title' => 'Collections', 'collections' => $collections]);
  }

  public function show ($id) {

    $collection = Collection::getCollectionWithContent($id);
    $posts = \App\Post::where('collection_id', $id)->paginate(15);

    return view('dashboard/collections/show', ['title' => 'Collections', 'collection' => $collection, 'posts' => $posts]);
  }

  public function collectionPosts($id) {
    $collection = Collection::getCollectionWithContent($id);
    $posts = \App\Post::where('collection_id', $id)->paginate(15);

    return view('dashboard/collections/posts', ['title' => 'Collections', 'collection' => $collection, 'posts' => $posts]);
  }

  public function edit ($id) {
    $collection = Collection::getCollectionWithContent($id);
    $posts = \App\Post::where('collection_id', $id)->paginate(15);
    $types = \App\Type::all();

    return view('dashboard/collections/manage-fields', ['title' => 'Collections', 'collection' => $collection, 'posts' => $posts, 'types' => $types]);
  }

  public function showPost ($collectionId, $postId) {
    $collection = Collection::getCollectionWithContent($collectionId);

    $posts = \App\Post::where('collection_id', $collectionId)->paginate(15);

    $post = \App\Post::where('id', $postId)->with(['content' => function ($q) {
      $q->with('type');
    }])->first();

    return view('dashboard/collections/post', ['title' => 'Collections', 'collection' => $collection, 'currentPost' => $post, 'posts' => $posts]);
  }

  public function postContent ($collectionId, $postId) {
    $collection = Collection::getCollectionWithContent($collectionId);

    $posts = \App\Post::where('collection_id', $collectionId)->paginate(15);

    $post = \App\Post::where('id', $postId)->with(['content' => function ($q) {
      $q->with('type');
    }])->first();

    return view('dashboard/collections/post-content', ['title' => 'Collections', 'collection' => $collection, 'currentPost' => $post, 'posts' => $posts]);
  }

  public function store (Request $req) {

    $collection = new Collection();

    $this->validate($req, [
      'name' => 'required',
    ]);

    $allPages = null;

    if (!isset($req['all-pages'])) {
      $allPages = 0;
    } else {
      $allPages = 1;
    }

    $collection['name'] = $req['name'];
    $collection['desc'] = $req['desc'];
    $collection['all_pages'] = $allPages;

    $collection->save();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($collection);
    }

  }

  public function update (Request $req, $id) {
    $this->validate($req, [
      'name' => 'required'
    ]);

    $allPages = 1;

    if (!isset($req['all-pages'])) {
      $allPages = 0;
    }

    $collection = Collection::where('id', $id);
    $collection->update([
      'name' => $req['name'],
      'all_pages' => $allPages,
      'desc' => $req['desc']
    ]);

    if (!$req->ajax()) {
      return back();
    }
  }

  public function deleteMultiple (Request $req) {
    $collection = Collection::findMany($req->ids)->toArray();
    DB::table('collections')->whereIn('id', $req->ids)->delete();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($collection);
    }
  }

  public function removeContent (Request $req, $id) {
    \App\CollectionContent::where('id', $id)->delete($id);
    \App\CollectionPost::where('collection_content_id', $id)->delete();

    if (!$req->ajax()) {
      return back();
    }
  }

  public function addContent (Request $req, $id) {
    $content = new \App\CollectionContent();
    $this->validate($req, [
      'name' => 'required',
      'type-id' => 'required'
    ]);

    $content['collection_id'] = $id;
    $content['name'] = $req['name'];
    $content['type_id'] = $req['type-id'];
    $content->save();

    $getContent = \App\CollectionContent::where('id', $content->id)->with('type')->first()->toArray();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($getContent);
    }

  }

  public function updateOrder (Request $req, $id) {
    $this->validate($req, [
      'order' => 'required',
      'id' => 'required'
    ]);

    foreach ($req['id'] as $key => $value) {
      // dd($req['order'][$key]);
      $collection = \App\CollectionContent::findOrFail($value);
      $collection->order = $req['order'][$key];
      $collection->save();
      $collectionPost = \App\CollectionPost::where('collection_content_id', '=', $collection->id);
      $collectionPost->update(['order' => $req['order'][$key]]);
    }

    if (!$req->ajax()) {
      return back();
    }
  }
}
