<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 9:53
 */
Route::group(['namespace'=>'Home'],function(){
    Route::get('info/info','InfoController@info');//项目简介
    Route::get('info/newList','InfoController@newList');//新手必看
    Route::get('info/newInfo','InfoController@newInfo');//新手必看文章页
    Route::get('info/sysList','InfoController@sysList');//系统公告
    Route::get('info/sysInfo','InfoController@sysInfo');//公告详情

});
