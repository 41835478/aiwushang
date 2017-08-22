<?php

	Route::get('users/index','UserController@index');//用户主页
	Route::get('users/myaccount','UserController@myaccount');//账户信息
	Route::get('users/myintegral','UserController@myintegral');//积分主页
	Route::get('users/recastIntegral','UserController@recastIntegral');//复投积分
	Route::get('users/consumption','UserController@consumption');//消费积分
	Route::get('users/looppoints','UserController@looppoints');//复投积分
	Route::get('users/turnmyintegral','UserController@turnmyintegral');//积分转账
	Route::get('users/ranking_orders','UserController@ranking_orders');//公排订单
	Route::get('users/myteam','UserController@myteam');//公排订单
	Route::get('users/activememberorders','UserController@activememberorders');//激活会员订单页面
	Route::get('users/accountsettings','UserController@accountsettings');//账户设置
	Route::get('users/modify_login','UserController@modify_login');//修改登录密码
	Route::get('users/modify_pay','UserController@modify_pay');//修改支付密码
	Route::post('users/userinfo','UserController@userinfo');//修改信息提交

?>