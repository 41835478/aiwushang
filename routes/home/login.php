<?php
Route::group(['namespace'=>'Home'],function(){
    Route::get('register/index','LoginController@index');//加载注册页面
    Route::get('register/agreement','LoginController@agreement');//加载用户注册协议页面
    Route::post('register/goRegister','LoginController@goRegister');//添加去注册
    Route::post('register/sendCode','LoginController@sendCode');//发送验证码
    Route::post('login/login','LoginController@login');//执行登录操作
    Route::get('forget/forgetPwd','LoginController@forgetPwd');//加载忘记密码操作
    Route::post('forget/editPwd','LoginController@editPwd');//执行忘记密码操作
});
?>