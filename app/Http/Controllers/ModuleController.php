<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Module;

class ModuleController extends Controller
{
  public function index () {

    $modules = Module::with('type')->get();
    return view('dashboard/modules/index', compact('modules'));

  }

  public function store (Request $req) {
    $module = new Module();

    $module->name = $req->name;
    $module->type_id = $req->type;

    $this->validate($req, [
      'name' => 'required',
      'type' => 'required'
    ]);

    $module->save();

    return redirect()->action('ModuleController@index');

  }

  public function create () {
      $types = \App\Type::where('purpose', 'module')->get();
      return view('dashboard/modules/create', compact('types'));
  }

  public function update () {
    // back-end update
  }

  public function show ($id) {
    $module = Module::where('id', $id)
      ->with('type')
      ->with('content');

    return view('dashboard/modules/show', compact('module'));
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

  public function destroyMultiple (Request $req) {
    Module::destroy($req['modules']);
    return back();
  }
}
