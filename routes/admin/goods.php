<?php
Route::get('goods/index/{mark?}','GoodsController@index');//加载添加商品视图
Route::get('goods/goodsList','GoodsController@goodsList');//加载商品列表视图
Route::get('goods/getGoodsClass','GoodsController@getGoodsClass');//获取商品分类
Route::get('goods/getInputForm','GoodsController@getInputForm');//获取添加商品中的input的表单
Route::post('goods/addGoods','GoodsController@addGoods');//执行添加商城商品操作
Route::post('goods/actGoodsArea','GoodsController@actGoodsArea');//执行添加商品专区操作
?>