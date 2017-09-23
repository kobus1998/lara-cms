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

    $pages = $pages->with('type')->paginate(15);

    // dd($pages);

    // $pages = Page::with('type')->paginate(2);

    return view('dashboard/pages/index', ['pages' => $pages, 'title' => 'Pages']);
  }

  public function store (Request $req) {

    $this->validate($req, [
      'name' => 'required|unique:pages,url',
      'type' => 'required|integer',
      'url' => 'required|unique:pages,url|not_in:cms,/cms',
    ]);

    $page = new Page();
    $page['name'] = $req['name'];
    $page['desc'] = $req['page-desc'];
    $page['type_id'] = $req['type'];
    $page['url'] = $req['url'];

    $page->save();

    return redirect()->action('PageController@index');
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

    // $contents = \App\Content::all();

    $page = Page::find($id)->with('content')->with('contentGroup')->with('type')->first();
    $contentGroups = \App\ContentGroup::find($page->contentGroup[0]->pivot->content_group_id)->with('content')->get();

    //
    // foreach ($page->content as $item) {
    //   array_push($pageContent, $item->id);
    // }
    //
    // $page['contentIds'] = $pageContent;
    //
    // dd($page['contentIds']);

    $pageContent = [];

    foreach ($page->content as $content) {
      $content['group'] = false;
      array_push($pageContent, $content);
    }

    foreach ($contentGroups as $contentGroup) {
      $contentGroup['group'] = true;
      array_push($pageContent, $contentGroup);
    }

    // dd($pageContent);

    $types = \App\Type::where('purpose', 'page')->get();

    return view('dashboard/pages/show', [
      'page' => $page,
      'types' => $types,
      'pageContents' => $pageContent,
      'contentGroups' => $contentGroups
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
