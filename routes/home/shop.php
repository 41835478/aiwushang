<?php
Route::group(['namespace'=>'Home'],function(){
    Route::get('shop/index','ShopController@index');//商城首页
    Route::get('shop/goodsDetail','ShopController@goodsDetail');//商品详情

    Route::get('shop/','ShopController@index');//商城首页
});
?>