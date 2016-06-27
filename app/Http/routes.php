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
Route::get('/admin','AdminController@index');
//用户操作
Route::controller('/admin/user','UserController');
//无限分类
Route::controller('/admin/cate','CateController');
//文章操作模块
Route::controller('/admin/article','ArticleController');
//Route::controller('/admin/type','TypeController');
// Route::get('/admin', function () {
//     return view('admin.index');
// });
