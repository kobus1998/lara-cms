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
      'name' => 'required|unique:pages,name',
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

  public function saveContentBody (Request $req, $pageId) {
    $page = Page::findOrFail($pageId);
    // return $req['content'];
    foreach ($req['content'] as $content) {
      if ($content['repeating'] == 0) {
        $page->content()->updateExistingPivot($content['id'], ['body' => $content['body']]);
      } else {
        // return $content;
        $contentId = $content['id'];
        foreach ($content['body'] as $body) {
          // return $body;
          if ($body['isNew'] == true) {
            $repeatingContent = new RepeatingContent();
            $repeatingContent['page_id'] = $contentId;
            $repeatingContent['body'] = $body['content'];
            $repeatingContent['created_at'] = Carbon::now();
            $repeatingContent['updated_at'] = Carbon::now();
            $repeatingContent->save();
          } else {

          }
        }

      }
    }

    return response()->json($page->with('content')->get());

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
    $page = Page::where('id', '=', $id)->with('content')->first();

    return view('dashboard/pages/seo', [
      'page' => $page,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => false],
        ['name' => 'SEO', 'action' => action('PageController@showSeo', $page->id), 'active' => true]
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

  public function saveContentManager(Request $req) {
    $response = [];
    foreach ($req->pages as $page) {
      $currentPage = Page::findOrFail($page['id'])->content();
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
            'updated_at' => Carbon::now()
          ]);
        }
      }
      array_push($response, $currentPage->get());
    }

    return response()->json($response);
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

  public function destroyContent (Request $req, $pageId, $contentId) {
    // $page = Page::findOrFail($pageId)->content();
    // $page->detach($contentId);
    \App\PageContent::findOrFail($contentId)->delete();
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
