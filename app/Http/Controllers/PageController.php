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
    $page['name'] = $req['name'];
    $page['desc'] = $req['page-desc'];
    $page['type_id'] = $req['type'];
    $page['url'] = $req['url'];

    $this->validate($req, [
      'name' => 'required|unique:pages,url',
      'type' => 'required|integer',
      'url' => 'required|unique:pages,url|not_in:cms,/cms',
    ]);

    $page->save();

    return redirect()->action('PageController@index')->with('success', 'Page is created');
  }

  public function create () {
    $types = \App\Type::where('purpose', 'page')->get();
    return view('dashboard/pages/create', ['types' => $types]);
  }

  public function update (Request $req, $id) {

    $page = Page::findOrFail($id);

    if ($req['req-type'] == 'general') {

      if (substr($req['url'], 0) == '/' || substr($req['page-url'], 0) == ' ') {
        ltrim($req['url'], 0);
      }

      $page['name'] = $req['name'];
      $page['desc'] = $req['desc'];
      $page['url'] = $req['url'];
      $page['type_id'] = $req['type'];

      $this->validate($req, [
        'name' => 'required',
        'type' => 'required|integer',
        'url' => 'required|not_in:cms',
      ]);

    } else if ($req['req-type'] == 'seo') {
      $page['seo_title'] = $req['seo-title'];
      $page['seo_desc'] = $req['seo-desc'];
      $page['seo_keywords'] = $req['seo-keywords'];
    }

    $page->update();

    return back();

  }

  public function show ($id) {

    $contents = \App\Content::all();

    $page = Page::where('id', $id)
      ->with('content')
      ->with('type')
      ->first();

    $pageContent = [];

    foreach ($page->content as $item) {
      array_push($pageContent, $item->id);
    }

    $page['contentIds'] = $pageContent;

    $types = \App\Type::where('purpose', 'page')->get();
    return view('dashboard/pages/show', ['page' => $page, 'types' => $types, 'contents' => $contents]);
  }

  public function edit () {
    // form update
  }

  public function destroy () {
    // back-end remove
  }

  public function addContent(Request $req, $pageId) {

    // dd(['req' => $req, 'page' => $pageId]);

    $page = \App\PageContent::where('page_id', $pageId)->delete();

    if (count($req->id) > 0) {

      foreach ($req->id as $contentId) {

        $pageContent = new \App\PageContent();

        $pageContent->content_id = $contentId;
        $pageContent->page_id = $pageId;
        $pageContent->order = 1;

        $pageContent->save();
      }
    }

    return back();
  }

  public function destroyMultiple (Request $req) {
    Page::destroy($req['pages']);

    return back();
  }

  public function route ($url, $id = null) {

    if ($id == null) {
      $page = Page::where('url', $url)->with('content')->first();
      dd($page);
    } else {
      $page = Page::where('url', $url)->with('content')->first();
      $content = \App\Content::where('id', $id)->first();
      dd($page, $content);
    }


  }

}
