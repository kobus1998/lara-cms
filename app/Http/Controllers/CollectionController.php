<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Collection;
use \App\Page;
use App\CollectionPost;

class CollectionController extends Controller
{

  public function index (Request $req) {
    $searchQuery = app('request')->input('s');

    if (count($searchQuery) > 0) {
      $collections = Collection::searchCollection($searchQuery);
    } else {
      $collections = Collection::getAllCollections();
    }


    return view('dashboard/collections/index', [
      'collections' => $collections,
      'navs' => [
        ['name' => 'Collections', 'action' => action('CollectionController@index'), 'active' => true],
      ],
    ]);
  }

  public function show ($id) {

    $collection = Collection::getCollectionWithContent($id);
    $posts = \App\Post::where('collection_id', $id)->where('is_active', '=', 1)->paginate(15);

    return view('dashboard/collections/show', [
      'collection' => $collection,
      'posts' => $posts,
      'navs' => [
        ['name' => 'Collections', 'action' => action('CollectionController@index'), 'active' => false],
        ['name' => $collection->name, 'action' => action('CollectionController@show', $collection->id), 'active' => true]
      ],
    ]);
  }

  public function collectionPosts($id) {
    $searchQuery = app('request')->input('s');

    $collection = Collection::getCollectionWithContent($id);
    $posts = \App\Post::where('collection_id', $id)->where('is_active', '=', 1);

    if (count($searchQuery) > 0) {
      $posts = $posts->where('name', 'like', '%'.$searchQuery.'%');
    }
    $posts = $posts->paginate(15);

    return view('dashboard/collections/posts', [
      'collection' => $collection,
      'posts' => $posts,
      'navs' => [
        ['name' => 'Collections', 'action' => action('CollectionController@index'), 'active' => false],
        ['name' => $collection->name, 'action' => action('CollectionController@show', $collection->id), 'active' => false],
        ['name' => 'Posts', 'action' => action('CollectionController@collectionPosts', $collection->id), 'active' => true]
      ],
    ]);
  }

  public function edit ($id) {
    $collection = Collection::getCollectionWithContent($id);
    $posts = \App\Post::where('collection_id', $id)->where('is_active', '=', 1)->paginate(15);
    $types = \App\Type::all();

    return view('dashboard/collections/manage-fields', ['title' => 'Collections', 'collection' => $collection, 'posts' => $posts, 'types' => $types]);
  }

  public function showPost ($collectionId, $postId) {
    $collection = Collection::getCollectionWithContent($collectionId);

    $posts = \App\Post::where('collection_id', $collectionId)->where('is_active', '=', 1)->paginate(15);

    $post = \App\Post::where('id', $postId)->where('is_active', '=', 1)->with(['content' => function ($q) {
      $q->with('type');
    }])->first();

    return view('dashboard/collections/post', [
      'collection' => $collection,
      'currentPost' => $post,
      'posts' => $posts,
      'navs' => [
        ['name' => 'Collections', 'action' => action('CollectionController@index'), 'active' => false],
        ['name' => $collection->name, 'action' => action('CollectionController@show', $collection->id), 'active' => false],
        ['name' => 'Posts', 'action' => action('CollectionController@collectionPosts', $collection->id), 'active' => false],
        ['name' => $post->name, 'action' => action('CollectionController@showPost', ['postId' => $post->id, 'collectionId' => $collection->id]), 'active' => true]
      ],
    ]);
  }

  public function postContent ($collectionId, $postId) {
    $collection = Collection::getCollectionWithContent($collectionId);

    $posts = \App\Post::where('collection_id', $collectionId)->where('is_active', '=', 1)->paginate(15);

    $post = \App\Post::where('id', $postId)->where('is_active', '=', 1)->with(['content' => function ($q) {
      $q->with('type');
    }])->first();

    return view('dashboard/collections/post-content', [
      'collection' => $collection,
      'currentPost' => $post,
      'posts' => $posts,
      'navs' => [
        ['name' => 'Collections', 'action' => action('CollectionController@index'), 'active' => false],
        ['name' => $collection->name, 'action' => action('CollectionController@show', $collection->id), 'active' => false],
        ['name' => 'Posts', 'action' => action('CollectionController@collectionPosts', $collection->id), 'active' => false],
        ['name' => $post->name, 'action' => action('CollectionController@showPost', ['postId' => $post->id, 'collectionId' => $collection->id]), 'active' => false],
        ['name' => 'Content', 'action' => action('CollectionController@postContent', ['postId' => $post->id, 'collectionId' => $collection->id]), 'active' => true]
      ],
    ]);
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

    DB::table('collections_contents')->insert([
      [
        'collection_id' => $collection->id,
        'name' => 'Title',
        'type_id' => 1,
        'order' => 0
      ],[
        'collection_id' => $collection->id,
        'name' => 'Content',
        'type_id' => 2,
        'order' => 1
      ],
    ]);

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

  public function setInactiveMultiple (Request $req) {
    $collection = Collection::whereIn('id', $req->ids);
    $collection->update(['is_active' => 0]);

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($collection);
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

  public function deleteContent (Request $req, $collectionId, $contentId) {
    $pageContent = \App\CollectionContent::destroy($contentId);
    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($pageContent);
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

    $posts = \App\Post::where('collection_id', '=', $id)->select('id as id')->get();

    foreach ($posts as $post) {
      $cc = new \App\CollectionPost;
      $cc->post_id = $post->id;
      $cc->collection_content_id = $content->id;
      $cc->save();
    }

    $getContent = \App\CollectionContent::where('id', $content->id)->with('type')->first()->toArray();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($getContent);
    }

  }

  public function editContent (Request $req, $id) {

    foreach ($req->items as $item) {
      $collection = \App\CollectionContent::where('id', '=', $item['id']);
      $collection->update([
        'order' => $item['order'],
        'name' => $item['name'],
        'type_id' => $item['type']
      ]);

      $collection = $collection->first();
      $collectionPost = \App\CollectionPost::where('collection_content_id', '=', $collection->id);
      $collectionPost->update(['order' => $item['order']]);
    }

    if (!$req->ajax()) {
      return back();
    }
  }
}
