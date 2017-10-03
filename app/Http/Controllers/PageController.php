<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Page;
use Carbon\Carbon;
use App\PageContent;
use App\RepeatingContent;
use Illuminate\Support\Facades\Storage;

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
      'url' => 'required|not_in:cms,/cms',
    ]);

    $page = new Page();
    $page['name'] = $req['name'];
    $page['desc'] = $req['desc'];
    $page['url'] = $req['url'];

    $page->save();

    DB::table('pages_content')->insert([
      ['page_id' => $page->id, 'type_id' => 1, 'name' => 'Title', 'order' => 0],
      ['page_id' => $page->id, 'type_id' => 2, 'name' => 'Content', 'order' => 1],
    ]);

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

    $this->validate($req, [
      'name' => 'required',
      'url' => 'required|not_in:cms',
    ]);

    $page = Page::where('id', '=', $id);

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
    $page = Page::where('id', '=', $id)->with(['content' => function ($q) {
      $q->with('repeatingContent');
      $q->with('type');
    }])->first();

    $medias = \App\Media::all();

    foreach ($medias as $media) {
      $media->small = Storage::disk('image')->url($media->small);
    }

    $types = \App\Type::get();

    return view('dashboard/pages/content', [
      'page' => $page,
      'types' => $types,
      'medias' => $medias,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => false],
        ['name' => 'Content', 'action' => action('PageController@showContent', $page->id), 'active' => true]
      ],
    ]);
  }

  public function showManageFields ($id) {
    $page = Page::where('id', '=', $id)->with(['content' => function ($q) {
      $q->with('repeatingContent');
      $q->with('type');
    }])->first();

    $types = \App\Type::get();

    return view('dashboard/pages/manage-fields', [
      'page' => $page,
      'types' => $types,
      'navs' => [
        ['name' => 'Pages', 'action' => action('PageController@index'), 'active' => false],
        ['name' => $page->name, 'action' => action('PageController@show', $page->id), 'active' => false],
        ['name' => 'Manage Fields', 'action' => action('PageController@showManageFields', $page->id), 'active' => true]
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

  public function showCollections ($id) {

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

  public function updateContent (Request $req, $id) {
    // dd($req->request);
    foreach ($req->items as $item) {
      if ($item['is-repeatable'] == 1) {
        foreach ($item['repeatable'] as $repeatable) {
          $rep = \App\RepeatingContent::where('id', '=', $repeatable['id']);
          $rep->update([
            'order' => $repeatable['order'],
            'content' => $repeatable['content']
          ]);
        }
      } else {
        $content = \App\PageContent::where('id', '=', $item['id']);
        $content->update([
          'content' => $item['content']
        ]);
      }
    }

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($content);
    }

  }

  public function addContent(Request $req, $id) {
    $this->validate($req, [
      'name' => 'required',
      'type-id' => 'required'
    ]);

    $pageContent = new \App\PageContent();
    $pageContent->name = $req->name;
    $pageContent->type_id = $req['type-id'];
    $pageContent->page_id = $id;
    $pageContent->save();

    $contentId = $pageContent['id'];
    $content = \App\PageContent::where('id', '=', $contentId)->with('type')->first();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($content);
    }
  }

  public function editContent (Request $req, $id) {
    foreach ($req->items as $item) {
      $repeatable = 0;
      if (isset($item['repeatable'])) {
        $repeatable = 1;
      }

      $pageContent = \App\PageContent::where('id', '=', $item['id']);
      $pageContent->update([
        'order' => $item['order'],
        'name' => $item['name'],
        'type_id' => $item['type'],
        'repeatable' => $repeatable
      ]);
    }

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json(1);
    }

  }

  public function addRepeatingContent (Request $req, $id) {
    $repeatingContent = new \App\RepeatingContent;
    $repeatingContent->repeatable_id = $id;
    $repeatingContent->repeatable_type = 'App\PageContent';
    $repeatingContent->save();

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($repeatingContent);
    }
  }

  public function deleteRepeatingContent (Request $req, $id) {
    $repeatingContent = \App\RepeatingContent::destroy($id);

    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($repeatingContent);
    }
  }

  public function deleteContent(Request $req, $pageId, $contentId) {
    $pageContent = \App\PageContent::destroy($contentId);
    if (!$req->ajax()) {
      return back();
    } else {
      return response()->json($pageContent);
    }
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

    $page = Page::where('url', '=', $url)->with(['content' => function ($q) {
      $q->with('repeatingContent');
    }])->where('is_active', '=', 1)->first();

    $collections = \App\Collection::where('all_pages', '=', 1)->where('is_active', '=', 1)->get();


    if ($page->layout == 'index') {
      return view('themes/theme-name/index', compact('page'));
    }



  }

}
