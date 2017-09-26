<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Page;
use Carbon\Carbon;
use App\RepeatingContent;

class PageController extends Controller
{

  public function index () {
    $search = app('request')->input('s');

    $pages = new Page;

    if ($search != null) {
      $pages = $pages::where('name', 'LIKE', '%'.$search.'%')->orderBy('created_at', 'desc');
    } else {
      $pages = $pages::orderBy('created_at', 'desc');
    }

    $pages = $pages->where('is_active', '=', '1')->with('type')->paginate(15);

    return view('dashboard/pages/index', [
      'pages' => $pages, 'title' => 'Pages',
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => true],
      ],
    ]);
  }

  public function store (Request $req) {

    $this->validate($req, [
      'name' => 'required',
      'url' => 'required|unique:pages,url|not_in:cms,/cms',
    ]);

    $page = new Page();
    $page['name'] = $req['name'];
    $page['desc'] = $req['page-desc'];
    $page['url'] = $req['url'];

    $page->save();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($page);
    }

  }

  public function create () {
    $types = \App\Type::where('purpose', 'page')->get();
    return view('dashboard/pages/create', ['types' => $types]);
  }

  public function update (Request $req, $id) {

    $page = Page::where('id', '=', $id);

    $this->validate($req, [
      'name' => 'required',
      'url' => 'required|not_in:cms',
    ]);

    $page->update([
      'name' => $req['name'],
      'url' => $req['url'],
      'desc' => $req['desc']
    ]);

    if(!$req->ajax()) {
      return back();
    } else {
      return response()->json($page);
    }

  }

  public function updateSeo (Request $req, $id) {
    $page = Page::where('id', '=', $id);
    $page->update([
      'seo_title' => $req['seo-title'],
      'seo_keywords' => $req['seo-keywords'],
      'seo_desc' => $req['seo-desc']
    ]);

    if(!$req->ajax()) {
      return back();
    } else {
      return response()->json($page);
    }
  }

  public function show ($id) {
    $page = Page::where('id', '=', $id)->with('content')->first();

    return view('dashboard/pages/show', [
      'page' => $page,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => true]
      ],
    ]);
  }

  public function showContent ($id) {
    $page = Page::where('id', '=', $id)->with('content')->first();

    return view('dashboard/pages/content', [
      'page' => $page,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => false],
        ['name' => 'Content', 'action' => action('PageController@showContent', $page->id), 'active' => true]
      ],
    ]);
  }

  public function showSeo ($id) {
    $page = Page::where('id', '=', $id)->first();

    return view('dashboard/pages/seo', [
      'page' => $page,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => false],
        ['name' => 'SEO', 'action' => action('PageController@showSeo', $page->id), 'active' => true]
      ],
    ]);
  }

  public function showSettings ($id) {
    $page = Page::where('id', '=', $id)->first();

    return view('dashboard/pages/settings', [
      'page' => $page,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => false],
        ['name' => 'Settings', 'action' => action('PageController@showSettings', $page->id), 'active' => true]
      ],
    ]);
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

  public function setInactiveMultiple (Request $req) {
    $pages = Page::whereIn('id', $req->ids);
    $pages->update(['is_active' => 0]);

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($pages);
    }
  }

  public function destroyMultiple (Request $req) {
    Page::destroy($req['pages']);

    return back();
  }

  public function route ($url, $id = null) {
    $data = [];

    $modules = \App\Module::get();

    if ($id == null) {
      $page = Page::where('url', $url)->with('content')->first();
      $data['page'] = $page;
    } else {
      $page = Page::where('url', $url)->with('content')->first();

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
