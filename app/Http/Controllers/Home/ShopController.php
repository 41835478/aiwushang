<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller{
    const USER_ID = 'user_id';
    const LUNBO = 'advertisement';
    const GOODS = 'goods';
    const CART = 'goodscart';
    //首页
    public function index(){
        $lunbo = DB::table(self::LUNBO)->where(['type'=>1,'status'=>0])->get();    //轮播图
        $goods = DB::table(self::GOODS)->orWhereIn('type',['4','5','6'])->where(['status'=>1])->get();
        $return = [
            'lunbo'=>$lunbo,
            'goods'=>$goods
        ];
        return view('home.shop.index',$return);
    }

    //商品详情
    public function goodsDetail(){
        $id = $_REQUEST['id'];
        $goods = DB::table(self::GOODS)->where(['id'=>$id])->first();
        $goods->small_pic = trim($goods->small_pic,']"');
        $goods->small_pic = trim($goods->small_pic,'"[');
        $goods->small_pic = explode('","',$goods->small_pic);
//        var_dump($goods);
        $return = [
            'goods'=>$goods
        ];
        return view('home.shop.goodsDetail',$return);
    }

    //购物车
    public function cart(){
        session(['user_id'=>1]);
        $user_id = session(self::USER_ID);
        $cart = DB::table(self::CART)->where(['user_id'=>$user_id])->get()->toArray();
        foreach($cart as $k=>$v){
            $cart[$k]->goods = DB::table(self::GOODS)->where(['id'=>$v->goods_id])->first();
        }
        $return = [
            'cart'=>$cart
        ];
        return view('home.shop.cart',$return);
    }

    //加入购物车
    public function addCart(){
        session(['user_id'=>1]);
        $insert['num'] = $_REQUEST['num'];
        $insert['goods_id'] = $_REQUEST['goods_id'];
        $insert['user_id'] = session(self::USER_ID);
        $insert['create_at'] = time();
        $goods = DB::table(self::GOODS)->where(['id'=>$insert['goods_id']])->first();
        if(in_array($goods->type,[4,5,6])){
            $insert['type'] = 1;
        }else{
            $insert['type'] = 2;
        }
        $insert['price'] = round($insert['num'] * $goods->price,2);
        $res = DB::table(self::CART)->where(['user_id'=>$insert['user_id'],'goods_id'=>$insert['goods_id']])->first();
        if($res){
            $update['num'] = $res->num + $insert['num'];
            $update['price'] = $res->price + $insert['price'];
            $yn = DB::table(self::CART)->where(['id'=>$res->id])->update($update);
        }else{
            $yn = DB::table(self::CART)->insert($insert);
        }

        if($yn){
            echo 1;
        }else{
            echo 2;
        }
    }

    //修改购物车数量
    public function cartEdit(){
        $update['num'] = $_REQUEST['num'];
        $id = $_REQUEST['id'];
        DB::table(self::CART)->where(['id'=>$id])->update($update);
        echo 1;
    }

    //删除购物车
    public function cartDel(){
        $all_id = explode(',',trim($_REQUEST['xz_arr'],','));
        $res = DB::table(self::CART)->whereIn('id',$all_id)->delete();
        echo $res;
    }
}

