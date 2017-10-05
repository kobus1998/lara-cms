<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use \App\Theme;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ThemeController extends Controller
{
  public function index () {

    $storage = Storage::disk('themes')->directories();

    $themes = [];

    foreach ($storage as $theme) {
      $json = json_decode(Storage::disk('themes')->get($theme.'/theme.json'), true);
      $themes[] = $json;
    }

    return view('dashboard/themes/index', ['themes' => $themes]);
  }

  public function show ($slug) {
    $theme = json_decode(Storage::disk('themes')->get($slug.'/theme.json'), true);
    return view('dashboard/themes/show', ['theme' => $theme]);
  }

  public function store (Request $req) {

    $this->validate($req, [
      'name' => 'required'
    ]);

    $themes = Storage::disk('themes')->directories();

    if (in_array($req['name'], $themes)) {
      return back();
    }

    $theme = new Theme;
    $theme::create([
      'name' => $req->name,
      'author' => Auth::user()->name,
      'desc' => $req->desc,
    ]);

    return back();
  }
}
