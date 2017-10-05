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
      Route::put('/{id}', 'MediaController@update');
      Route::get('/upload', 'MediaController@upload');
      Route::delete('/delete', 'MediaController@delete');
    });

    Route::get('/{id}', 'MediaController@show');

  });

  Route::group(['middleware' => 'auth'], function () {

    Route::get('/dashboard', 'DashboardController@index');

    // page

    Route::resource('page', 'PageController');
    Route::get('/page/{pageId}/content', 'PageController@showContent');
    Route::get('/page/{pageId}/seo', 'PageController@showSeo');
    Route::get('/page/{pageId}/manage-fields', 'PageController@showManageFields');
    Route::get('/page/{pageId}/settings', 'PageController@showSettings');
    Route::get('/page/{pageId}/collections', 'PageController@showCollections');
    Route::put('/page/{pageId}/seo', 'PageController@updateSeo');

    Route::put('/page/{pageId}/update-content', 'PageController@updateContent');
    Route::post('/page/{pageId}/add-content', 'PageController@addContent');
    Route::put('/page/{pageId}/edit-content', 'PageController@editContent');
    Route::delete('/page/{pageId}/delete-content/{contentId}', 'PageController@deleteContent');
    Route::post('/multiple/page/set-inactive', 'PageController@setInactiveMultiple');

    Route::post('/page/{id}/add-repeating-content', 'PageController@addRepeatingContent');
    Route::delete('/page/{id}/delete-repeating-content', 'PageController@deleteRepeatingContent');

    // collection

    Route::resource('collection', 'CollectionController');
    Route::get('/collection/{collectionId}/post/{postId}', 'CollectionController@showPost');
    Route::get('/collection/{collectionId}/post/{postId}/content', 'CollectionController@postContent');

    Route::post('/collection/{collectionId}/add-content', 'CollectionController@addContent');
    Route::put('/collection/{collectionId}/edit-content', 'CollectionController@editContent');
    Route::delete('/collection/{collectionId}/delete-content/{contentId}', 'CollectionController@deleteContent');

    Route::get('/collection/{collectionId}/posts', 'CollectionController@collectionPosts');

    Route::put('/multiple/collection/set-inactive', 'CollectionController@setInactiveMultiple');
    Route::post('/multiple/collection/delete', 'CollectionController@deleteMultiple');

    // pot

    Route::resource('post', 'PostController');

    Route::put('/post/{id}/update-content', 'PostController@updateContent');
    Route::post('/post/{id}/add-repeating-content', 'PostController@addRepeatingContent');
    Route::delete('/post/{id}/delete-repeating-content', 'PostController@deleteRepeatingContent');

    Route::put('/multiple/post/set-inactive', 'PostController@setInactiveMultiple');
    Route::post('/multiple/post/delete', 'PostController@deleteMultiple');


  });

});


Route::get('/{url}', 'PageController@route');
Route::get('/{url}/{id?}', 'PageController@route');
