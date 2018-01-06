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

Route::get('/', function () {
    echo 'Hello Christian ~';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

$front_page = config('mysetting.front_page','front');
Route::group(['prefix'=>$front_page,'namespace'=>'Front','middleware'=>['checktime']],function(){
	Route::any('auth','OpenwechatController@auth');
	Route::any('callback/{appid}/callback','OpenwechatController@index');
	Route::get('/','FrontController@index');
	Route::resource('category','CategoryController');
	Route::resource('volume','VolumeController');
	Route::resource('chapter','ChapterController');
	Route::resource('detail','DetailController');
});