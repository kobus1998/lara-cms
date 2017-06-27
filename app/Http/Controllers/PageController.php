<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;

class PageController extends Controller
{

  public function index () {
    $pages = Page::with('type')->get();
    return view('dashboard/pages/index', compact('pages'));
  }

  public function store (Request $req) {
    $page = new Page();
    $page['page_name'] = $req['page-name'];
    $page['page_desc'] = $req['page-desc'];
    $page['type_id'] = $req['type'];
    $page['url'] = $req['page-url'];

    $this->validate($req, [
      'page-name' => 'required',
      'type' => 'required|integer',
      'page-url' => 'required'
    ]);

    $page->save();

    return redirect()->action('PageController@index')->with('success', 'Page is created');
  }

  public function create () {
    $types = \App\Type::all();
    return view('dashboard/pages/create', ['types' => $types]);
  }

  public function update () {
    // back-end update
  }

  public function show ($id) {
    // show single
    $page = Page::findOrFail($id)->with('content')->with('type')->get();
    $types = \App\Type::all();
    return view('dashboard/pages/show', ['page' => $page[0], 'types' => $types]);
  }

  public function edit () {
    // form update
  }

  public function destroy () {
    // back-end remove
  }

  public function destroyMultiple (Request $req) {
    Page::destroy($req['pages']);

    return back();
  }

}
