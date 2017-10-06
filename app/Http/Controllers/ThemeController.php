<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use \App\Theme;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use \App\Cms;

class ThemeController extends Controller
{
  public function index () {
    $themes = Theme::getAllThemes();
    return view('dashboard/themes/index', ['themes' => $themes]);
  }

  public function show ($slug) {
    $theme = Theme::getTheme($slug);
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
      'name' => $req->name
    ]);

    return back();
  }
}
