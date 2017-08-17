<?php

	#轮播图
    Route::get('banner/index','Admin\BannerController@index');//轮播图页面
	Route::any('banner/add','Admin\BannerController@add');//添加页面
	Route::post('banner/addinfo','Admin\BannerController@add');//添加处理
	Route::any('banner/edit/{id}','Admin\BannerController@edit');//修改页面
	Route::any('banner/del/{id}','Admin\BannerController@del');//删除处理
    Route::post('banner/editinfo','Admin\BannerController@editinfo');//执行修改管理员信息操作


 //    #公告notice
 //    Route::get('banner/noticeindex','Admin\BannerController@index');//轮播图页面
	// Route::any('banner/noticeadd','Admin\BannerController@add');//添加处理
	// Route::post('banner/noticeaddinfo','Admin\BannerController@add');//添加处理
	// Route::any('banner/noticeedit/{id}','Admin\BannerController@edit');//修改页面
	// Route::any('banner/noticedel/{id}','Admin\BannerController@del');//删除处理
 //    Route::post('banner/noticeeditinfo','Admin\BannerController@editinfo');//执行修改管理员信息操作

 //    #简介brief
 //    Route::get('banner/briefindex','Admin\BannerController@index');//轮播图页面
	// Route::any('banner/briefadd','Admin\BannerController@add');//添加处理
	// Route::post('banner/briefaddinfo','Admin\BannerController@add');//添加处理
	// Route::any('banner/briefedit/{id}','Admin\BannerController@edit');//修改页面
	// Route::any('banner/briefdel/{id}','Admin\BannerController@del');//删除处理
 //    Route::post('banner/briefeditinfo','Admin\BannerController@editinfo');//执行修改管理员信息操作
 //    #新手必看novice
 //    Route::get('banner/noviceindex','Admin\BannerController@index');//轮播图页面
	// Route::any('banner/noviceadd','Admin\BannerController@add');//添加处理
	// Route::post('banner/noviceaddinfo','Admin\BannerController@add');//添加处理
	// Route::any('banner/noviceedit/{id}','Admin\BannerController@edit');//修改页面
	// Route::any('banner/novicedel/{id}','Admin\BannerController@del');//删除处理
 //    Route::post('banner/noviceeditinfo','Admin\BannerController@editinfo');//执行修改管理员信息操作




