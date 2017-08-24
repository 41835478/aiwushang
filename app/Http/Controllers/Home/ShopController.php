<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller{
    const USER_ID = 'user_id';      //用户session名
    const LUNBO = 'advertisement';  //轮播图
    const GOODS = 'goods';          //商品表
    const CART = 'goodscart';       //购物车表
    const ADDRESS = 'address';      //用户地址表
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

    //购物车确认
    public function submitOrders(){
        session(['user_id'=>1]);
        $user_id = session(self::USER_ID);
        $all_money = 0;
        $goods = '';
        $cart = '';
        if(!empty($_REQUEST['goods_id'])){
            $goods = DB::table(self::GOODS)->where(['id'=>$_REQUEST['goods_id']])->first();
            $goods->paynum = $_REQUEST['num'];
            $all_money = round($goods->price * $_REQUEST['num'],2);
        }else{
            $cart_id = explode(',',$_REQUEST['cart_id']);
            $cart = DB::table(self::CART)->whereIn('id',$cart_id)->get()->toArray();
            foreach($cart as $k=>$v){
                $cart[$k]->goods = DB::table(self::GOODS)->where(['id'=>$v->goods_id])->first();
                $all_money += $v->price;
            }
        }
        if(!session('default_address')){
            $address = DB::table(self::ADDRESS)->where(['user_id'=>$user_id])->orderByDesc('default')->first();
        }else{
            $address = DB::table(self::ADDRESS)->where(['id'=>session('default_address')])->orderByDesc('default')->first();
        }
        if(!$address){
            redirect('/users/address');
        }
        $return = [
            'address' => $address,
            'cart' => $cart,
            'goods' => $goods,
            'all_money' => $all_money
        ];
        if(!empty($cart_id)){
            session(['cart_id'=>$cart_id]);
        }
        if(!empty($goods)){
            session(['goods_id'=>$goods->id]);
            session(['goods_num'=>$goods->paynum]);
        }
        session(['default_address'=>$address->id]);
        session(['all_money'=>$all_money]);

        return view('home.shop.submitOrders',$return);
    }

    //跳转支付页
    public function payment(){
        session(['user_id'=>1]);
        $add_order['user_id'] = session(self::USER_ID);
//        $add_order['order_code'] =
    }
}

