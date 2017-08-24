<?php
Route::group(['namespace'=>'Home'],function(){
    Route::get('shop/index','ShopController@index');//商城首页
    Route::get('shop/goodsDetail','ShopController@goodsDetail');//商品详情

    Route::get('/shop/cart','ShopController@cart');     //购物车---------需登录
    Route::get('/shop/addCart','ShopController@addCart');   //加入购物车------需登录
    Route::get('/shop/cartEdit','ShopController@cartEdit'); //购物车修改 ------需登录
    Route::get('/shop/cartDel','ShopController@cartDel'); //购物车删除 ------需登录
    Route::get('/shop/submitOrders','ShopController@submitOrders');//购物车确认页------需登录
    Route::get('/shop/payment','ShopController@payment');   //购买页------需登录

    Route::get('shop/','ShopController@index');//商城首页
});
?>