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
    return view('welcome');
});

Route::get('captcha/{tmp}','Admin\CaptchaController@captcha');//验证码
Route::group(['namespace' => 'Admin','middleware'=>'admin'], function () {
    //后台首页开始
    Route::get('admin/index', 'BaseController@index')->name('admin.index');
    Route::get('index/index', 'IndexController@index');
    //后台首页结束
});
require base_path('routes/admin/user.php');
require_once base_path('routes/admin/login.php');
