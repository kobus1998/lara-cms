<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModuleController extends Controller
{
  public function index () {
    // list of all x
  }

  public function store () {
    // back-end create
  }

  public function create () {
    // form create
  }

  public function update () {
    // back-end update
  }

  public function show () {
    // show single
  }

  public function edit () {
    // form update
  }

  public function addContent($moduleId, $contentId) {

    $moduleContent = new \App\ModuleContent();

    $moduleContent['module_id'] = $moduleId;
    $moduleContent['content_id'] = $contenId;

    $moduleContent->save();

    return back();
  }

  public function destroy () {
    // back-end remove
  }
}
