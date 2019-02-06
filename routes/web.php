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
Route::get('/feed', 'HomeController@feed')->name('feed');
Route::get('/news-{slug}', 'HomeController@news')->name('news.view');
Route::get('/i', 'HomeController@i')->name('image');

Route::group(['namespace' => 'Manager', 'prefix' => 'manager', 'middleware'=>'auth'], function(){ 
    /*
      Route::resource('news', 'NewsController')->names([
      'index' => 'manager.news.index',
      'create' => 'manager.news.create',
      'store' => 'manager.news.store',
      'show' => 'manager.news.show',
      'edit' => 'manager.news.edit',
      'update' => 'manager.news.update',
      'destroy' => 'manager.news.destroy',
      ]);
     */

    Route::resource('zen-channel', 'ZenChannelController')->names([
        'index' => 'manager.zen_channel.index',
        'create' => 'manager.zen_channel.create',
        'store' => 'manager.zen_channel.store',
        'show' => 'manager.zen_channel.show',
        'edit' => 'manager.zen_channel.edit',
        'update' => 'manager.zen_channel.update',
        'destroy' => 'manager.zen_channel.destroy',
    ]);
});

Auth::routes();
