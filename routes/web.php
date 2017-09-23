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

Route::prefix('cms')->group(function () {

  route::get('/', function () {
    return redirect('/cms/dashboard');
  });

  Auth::routes();

  Route::prefix('media')->group(function () {
    Route::group(['middleware' => 'auth'], function () {
      Route::get('/', 'MediaController@index');
      Route::post('/store', 'MediaController@store');
      Route::get('/upload', 'MediaController@upload');
      Route::delete('/delete', 'MediaController@delete');
    });

    Route::get('/{id}', 'MediaController@show');

  });

  Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@index');

    Route::resource('page', 'PageController');
    Route::resource('content', 'ContentController');
    Route::resource('collection', 'CollectionController');
    
    Route::get('/collection/{collectionId}/post/{postId}', 'CollectionController@showPost');
    Route::post('/collection/{collectionId}/add-content', 'CollectionController@addContent');
    Route::put('/collection/{collectionId}/update-order', 'CollectionController@updateOrder');
    Route::delete('/collection/{collectionId}/remove-content/{contentId}', 'CollectionController@removeContent');

    Route::resource('post', 'PostController');

  });

});


Route::get('/{url}', 'PageController@route');
Route::get('/{url}/{id?}', 'PageController@route');
