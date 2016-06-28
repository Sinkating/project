<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

//建立登陆   路由组
Route::group(['middleware'=>'login'],function(){

		Route::get('/admin','AdminController@index');
		//用户操作
		Route::controller('/admin/user','UserController');
		//无限分类
		Route::controller('/admin/cate','CateController');
		//文章操作模块
		Route::controller('/admin/article','ArticleController');
		//友情链接模块
		Route::controller('/admin/friendlink','FriendlinkController');
		//商品操作模块
		Route::controller('/admin/goods','GoodsController');
		
		//Route::controller('/admin/type','TypeController');
		// Route::get('/admin', function () {
		//     return view('admin.index');
		// });
	});
//后台登陆
		Route::get('/admin/login','LoginController@login');
		Route::get('/admin/logout','LoginController@logout');
		Route::post('/admin/login','LoginController@dologin');
