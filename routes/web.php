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

    Route::post('/multiple/page/set-inactive', 'PageController@setInactiveMultiple');

    Route::resource('content', 'ContentController');

    Route::resource('collection', 'CollectionController');

    Route::get('/collection/{collectionId}/post/{postId}', 'CollectionController@showPost');
    Route::get('/collection/{collectionId}/post/{postId}/content', 'CollectionController@postContent');
    Route::post('/collection/{collectionId}/add-content', 'CollectionController@addContent');
    Route::put('/collection/{collectionId}/update-order', 'CollectionController@updateOrder');
    Route::delete('/collection-content/{id}/remove-content', 'CollectionController@removeContent');
    Route::get('/collection/{collectionId}/posts', 'CollectionController@collectionPosts');

    Route::put('/multiple/collection/set-inactive', 'CollectionController@setInactiveMultiple');
    Route::post('/multiple/collection/delete', 'CollectionController@deleteMultiple');

    Route::resource('post', 'PostController');

    Route::put('/post/{postId}/update-content', 'PostController@updateContent');

    Route::put('/multiple/post/set-inactive', 'PostController@setInactiveMultiple');
    Route::post('/multiple/post/delete', 'PostController@deleteMultiple');


  });

});


Route::get('/{url}', 'PageController@route');
Route::get('/{url}/{id?}', 'PageController@route');
