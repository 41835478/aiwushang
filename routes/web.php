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

//后台路由
Route::get('captcha/{tmp}','Admin\CaptchaController@captcha');//验证码
Route::group(['namespace' => 'Admin','middleware'=>'admin'], function () {
    //后台首页开始
    Route::get('admin/index', 'BaseController@index')->name('admin.index');
    Route::get('index/index', 'IndexController@index');
    //后台首页结束
    require_once base_path('routes/admin/goodsClass.php');//商品分类
    require_once base_path('routes/admin/goods.php');//商品管理
    require_once base_path('routes/admin/banner.php');
    require_once base_path('routes/admin/member.php');

    require_once base_path('routes/admin/order.php');
    require_once base_path('routes/admin/Data.php');

    require_once base_path('routes/admin/withdraw.php');//提现管理

});
require base_path('routes/admin/user.php');//后台管理员管理
require_once base_path('routes/admin/login.php');//后台登录退出

//前台路由
Route::group(['namespace'=>'Home','middleware'=>'home'],function(){

});
require_once base_path('routes/home/login.php');//前台注册、登录