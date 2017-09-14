<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Carbon\Carbon;

class PageController extends Controller
{

  public function index () {

    $pages = Page::with('type')->paginate(2);

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

    return back();
  }

  public function saveContentManager(Request $req) {
    foreach ($req->pages as $page) {
      $currentPage = Page::findOrFail($page['page-id'])->content();
      foreach ($page['content'] as $pageContent) {
        if ($pageContent['isNew'] == true) {
          $currentPage->attach($pageContent['id'], [
            'order' => $pageContent['order'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon:: now()
          ]);
        } else {
          $currentPage->updateExistingPivot($pageContent['id'], [
            'order' => $pageContent['order'],
            'updated_at' => Carbon:: now()
          ]);
        }
      }
    }
  }

  public function destroyMultiple (Request $req) {
    Page::destroy($req['pages']);

    return back();
  }

  public function destroyContent (Request $req, $pageId, $contentId) {
    $page = Page::findOrFail($pageId)->content();
    $page->detach($contentId);
  }

  public function route ($url, $id = null) {
    $data = [];

    $modules = \App\Module::get();

    if ($id == null) {
      $page = Page::where('url', $url)->with('content')->first();
      $data['page'] = $page;
    } else {
      $page = Page::where('url', $url)->with('content')->first();
      $content = \App\Content::where('id', $id)->first();

      $data['page'] = $page;

      $data['content'] = $content;

    }

    dd([
      'data' => $data,
      'modules' => $modules
    ]);

    if ($page->layout == 'index') {
      return view('themes/theme-name/index', $data);
    }



  }

}
