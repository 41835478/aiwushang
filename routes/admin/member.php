<?php

	#会员操作

    Route::get('member/index','MemberController@index');//会员列表
	
	Route::any('member/edit/{id}','MemberController@edit');//修改页面
	Route::any('member/del','MemberController@del');//删除处理
    Route::post('member/editinfo','MemberController@editinfo');//执行修改信息操作

   

