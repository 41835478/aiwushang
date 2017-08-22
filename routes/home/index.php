<?php
Route::group(['namespace'=>'Home'],function(){
    Route::get('register/index','LoginController@index');//加载注册页面
    Route::get('register/agreement','LoginController@agreement');//加载用户注册协议页面
    Route::post('register/goRegister','LoginController@goRegister');//添加去注册
    Route::get('login/login','LoginController@login');//加载登录页面
});
?>