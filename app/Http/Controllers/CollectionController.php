<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \App\Collection;
use \App\Content;
use \App\Page;

class CollectionController extends Controller
{

  public function index () {

    $collections = \App\Post::getAllWithContent();

    dd($collections);

    return view('dashboard/collections/index');
  }

  public function show ($id) {

    $collections = Collection::contentEditorQuery($id);

    dd($collections);

    return view('dashboard/collections/show', compact('collection'));
  }
}
