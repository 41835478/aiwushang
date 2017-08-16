<?php


    Route::get('banner/index','Admin\BannerController@index');//轮播图页面
	Route::any('banner/add','Admin\BannerController@add');//添加处理
	Route::any('banner/edit/{id}','Admin\BannerController@edit');//修改页面
	Route::any('banner/del','Admin\BannerController@del');//删除处理
    Route::post('banner/editinfo','Admin\BannerController@editinfo');//执行修改管理员信息操作



		// Route::get('banner/editinfo/{name?}',function($name=null){
		// return 111;
		// });




