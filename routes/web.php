<?php

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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

  Route::delete('/dashboard/multiple/page', 'PageController@destroyMultiple');

  Route::get('/dashboard', 'DashboardController@index');

  Route::prefix('dashboard')->group(function () {
    Route::resource('page', 'PageController');
    Route::resource('module', 'ModuleController');
  });

});
