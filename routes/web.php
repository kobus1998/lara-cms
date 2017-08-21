<?php

use \App\Page;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::pattern('int','[0-9]');
// Route::pattern('str','[a-z]');

// Route::get('/', 'HomeController@index')->name('home');
//
// Route::get('/home', 'HomeController@index')->name('home');


Route::prefix('cms')->group(function () {

  route::get('/', function ($value='') {
    return redirect('/cms/dashboard');
  });

  Auth::routes();

  Route::group(['middleware' => 'auth'], function () {

    Route::prefix('content')->group(function () {
      Route::get('/create-group', 'ContentController@createGroup');
      Route::post('/create-group', 'ContentController@storeGroup');
    });

    Route::put('/multiple/content', 'ContentController@updateMultiple');

    Route::post('/multiple/page/addcontent/{pageId}', 'PageController@addContent');
    Route::post('/multiple/module/addcontent/{moduleId}', 'PageController@addContent');

    Route::delete('/multiple/page', 'PageController@destroyMultiple');
    Route::delete('/multiple/module', 'ModuleController@destroyMultiple');
    Route::delete('/multiple/content', 'ContentController@destroyMultiple');

    Route::get('/dashboard', 'DashboardController@index');

    Route::resource('page', 'PageController');
    Route::resource('module', 'ModuleController');
    Route::resource('content', 'ContentController');
  });

});


Route::get('/{url}', 'PageController@route');
Route::get('/{url}/{id?}', 'PageController@route');
