<?php

	Route::get('users/index','UserController@index');//用户主页
	Route::get('users/myaccount','UserController@myaccount');//账户信息
	Route::get('users/turnaccount','UserController@turnaccount');//余额转账
	Route::get('users/withdrawals','UserController@withdrawals');//账户体现
	Route::get('users/choosebnak','UserController@choosebnak');//选择银行卡
	Route::post('users/editaccount','UserController@editaccount');//余额提交


	Route::get('users/qrcode','UserController@qrcode');//账户体现

	Route::get('users/myintegral','UserController@myintegral');//积分主页
	Route::get('users/recastIntegral','UserController@recastIntegral');//复投积分
	Route::get('users/consumption','UserController@consumption');//消费积分
	Route::get('users/looppoints','UserController@looppoints');//复投积分
	Route::any('users/turnmyintegral/{id}','UserController@turnmyintegral');//积分转账
	Route::post('users/editintegral','UserController@editintegral');//积分转账提交

	Route::get('users/mybonus','UserController@mybonus');//我的奖金
	Route::any('users/bonus_jiandian/{id}','UserController@bonus_jiandian');//见点奖金奖金


	Route::get('users/ranking_orders','UserController@ranking_orders');//公排订单
	Route::get('users/myteam','UserController@myteam');//公排订单
	Route::get('users/activememberorders','UserController@activememberorders');//激活会员订单页面


	Route::get('users/accountbinding','UserController@accountbinding');//账户绑定页面
	Route::get('users/addbank','UserController@addbank');//添加银行卡页面
	Route::get('users/bindingaliplay','UserController@bindingaliplay');//绑定支付宝页面
	Route::post('users/bindingdel','UserController@bindingdel');//解除 删除绑定
		
	Route::post('users/editbinding','UserController@editbinding');//提交

	
?>