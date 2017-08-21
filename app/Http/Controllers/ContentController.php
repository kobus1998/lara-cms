<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Content;
use \App\ContentGroup;

class ContentController extends Controller
{
  public function index () {

    $content = Content::with('type')->with('group')->get();

    return view('dashboard/content/index', ['content' => $content]);

  }

  public function store (Request $req) {

    $content = new Content;

    $content['name'] = $req['name'];
    $content['body'] = '';
    $content['type_id'] = $req['type'];

    $this->validate($req, [
      'name' => 'required',
      'type' => 'required',
    ]);

    $content->save();

    return redirect()->action('ContentController@show', $content->id);

  }

  public function create () {
    // form create
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

    foreach ($req['id'] as $key => $val) {

      $item = \App\Content::findOrFail($val);
      if (strlen($req['content'][$key]) > 0) {
        $item['body'] = $req['content'][$key];
      }
      $item->update();
    }

    return back();

  }

  public function destroyMultiple (Request $req) {
    Content::destroy($req['contents']);

    return back();
  }
}
