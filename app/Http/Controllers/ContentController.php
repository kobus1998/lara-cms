<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Content;
use \App\ContentGroup;
use \App\Page;
use \App\Module;

class ContentController extends Controller
{
  public function index () {
    $search = app('request')->input('s');

    $pages = new Page;

    if ($search != null) {
      $pages = $pages::where('name', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc');
    } else {
      $pages = $pages::orderBy('created_at', 'desc');
    }

    $pages = $pages->whereHas('type', function ($query) {
      $query->whereIn('name', ['page']);
    })->with('content')->paginate(15);

    $content = Content::with('type')->with('group')->get();
    $types = \App\Type::where('purpose', 'content')->get();
    $contentGroups = ContentGroup::all();
    return view('dashboard/content/index', [
      'content' => $content,
      'viewContents' => $pages,
      'types' => $types,
      'groups' => $contentGroups
    ]);

  }

  public function store (Request $req) {

    $content = new Content;

    $content['name'] = $req['name'];
    $content['type_id'] = $req['type'];

    $this->validate($req, [
      'name' => 'required',
      'type' => 'required',
    ]);

    $content->save();

    return redirect()->action('ContentController@show', $content->id);

  }

  public function create () {
    $types = \App\Type::where('purpose', 'content')->get();
    return view('dashboard/content/create', ['types' => $types]);
  }

  public function createGroup () {
    return view('dashboard/content/create-group');
  }

  public function storeGroup (Request $req) {
    $group = new ContentGroup;
    $group['name'] = $req['name'];

    $this->validate($req, [
      'name' => 'required'
    ]);

    $group->save();

    return back();
  }

  public function update () {
    // back-end update
  }

  public function show () {
    // show single
  }

  public function edit () {
    // form update
  }

  public function destroy () {
    // back-end remove
  }

  public function updateMultiple (Request $req) {
    $pageId = $req['page-id'];

    foreach ($req['id'] as $key => $value) {
      $item = Page::findOrFail($pageId)->content();
      $item = $item->updateExistingPivot($value, ['body' => $req['content'][$key]]);
    }

    return back();

  }

  public function destroyMultiple (Request $req) {
    Content::destroy($req['contents']);

    return back();
  }
}
