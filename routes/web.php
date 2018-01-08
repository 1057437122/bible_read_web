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

$front_page = config('mysetting.front_page','front');
Route::get('/', function () use ($front_page){
    $permanent = 1;

    	header('Location: ' . URL('/'.$front_page.'/volume'), true, $permanent ? 301 : 302);

    	exit();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix'=>$front_page,'namespace'=>'Front','middleware'=>['checktime']],function(){
	Route::any('auth','OpenwechatController@auth');
	Route::any('callback/{appid}/callback','OpenwechatController@index');
	Route::get('/','FrontController@index');
	Route::resource('category','CategoryController');
	Route::resource('volume','VolumeController');
	Route::resource('chapter','ChapterController');
	Route::get('detail/search','DetailController@search');
	Route::resource('detail','DetailController');
});