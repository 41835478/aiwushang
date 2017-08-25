<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ShopController extends Controller{
    const USER_ID = 'user_id';      //用户session名
    const LUNBO = 'advertisement';  //轮播图
    const GOODS = 'goods';          //商品表
    const CART = 'goodscart';       //购物车表
    const ADDRESS = 'address';      //用户地址表
    const ORDER = 'order';          //订单表
    const ORDER_INFO = 'order_info';    //订单详情表
    const USER = 'user';                //用户表
    const GOODSCLASS = 'goodsclass';    //商品分类表
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
    public function submitOrders(Request $request){
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
            if(empty($cart)){
                echo "<script>location.href='/shop/cart'</script>";exit;
            }
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
        $request->session()->forget(['cart_id','goods_id','goods_num','default_address','all_money']);
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
    public function payment(Request $request){
        session(['user_id'=>1]);
        if(empty(session('default_address')) || empty(session('all_money')) || !empty($_REQUEST['order_id'])){

            $user = DB::table(self::USER)->where(['id'=>session(self::USER_ID)])->first();
            $order = DB::table(self::ORDER)->where(['id'=>$_REQUEST['order_id']])->first();
            $order_info = DB::table(self::ORDER_INFO)->where(['order_id'=>$order->id])->get()->toArray();
            $order->fx = 1;
            foreach($order_info as $k=>$v){
                if($v->type < 4){
                    $order->fx = 2;
                    break;
                }
            }
            $return = [
                'order' => $order,
                'user' => $user
            ];
            return view('home.shop.payment',$return);
        }

        $address = DB::table(self::ADDRESS)->where(['id'=>session('default_address')])->orderByDesc('default')->first();
        $add_order['user_id'] = session(self::USER_ID);
        $add_order['order_code'] = orderNum();
        $add_order['total_money'] = session('all_money');
        $add_order['status'] = 1;
        $add_order['name'] = $address->name;
        $add_order['phone'] = $address->phone;
        $add_order['province'] = $address->province;
        $add_order['city'] = $address->city;
        $add_order['area'] = $address->area;
        $add_order['address'] = $address->address;
        $add_order['create_at'] = time();
        $add_order['class'] = 1;
        $order_id = DB::table(self::ORDER)->insertGetId($add_order);
        if($order_id){
            $add_info['order_id'] = $order_id;
            if(!empty(session('cart_id'))){
                $carts = DB::table(self::CART)->whereIn('id',session('cart_id'))->get()->toArray();
                foreach($carts as $k=>$v){
                    $goods = DB::table(self::GOODS)->where(['id'=>$v->goods_id])->first();
                    $add_info['goods_id'] = $goods->id;
                    $add_info['name'] = $goods->name;
                    $add_info['price'] = $goods->price;
                    $add_info['num'] = $v->num;
                    $add_info['create_at'] = time();
                    $add_info['update_at'] = time();
                    $add_info['type'] = $goods->type;
                    DB::table(self::ORDER_INFO)->insert($add_info);
                }
                DB::table(self::CART)->whereIn('id',session('cart_id'))->delete();
            }else{
                $goods = DB::table(self::GOODS)->where(['id'=>session('goods_id')])->first();
                $add_info['goods_id'] = $goods->id;
                $add_info['name'] = $goods->name;
                $add_info['price'] = $goods->price;
                $add_info['num'] = session('goods_num');
                $add_info['create_at'] = time();
                $add_info['update_at'] = time();
                $add_info['type'] = $goods->type;
                DB::table(self::ORDER_INFO)->insert($add_info);
            }
        }
        $request->session()->forget(['cart_id','goods_id','goods_num','default_address','all_money']);
        echo "<script>location.href='/shop/payment?order_id={$order_id}'</script>";exit;
    }

    //商品分类
    public function BaihuoMall(){
        $type = $_REQUEST['type'];
        $class = DB::table(self::GOODSCLASS)->where(['type'=>$type,'pid'=>0])->get()->toArray();
        foreach($class as $k=>$v){
            $class[$k]->children = DB::table(self::GOODSCLASS)->where(['type'=>$type,'pid'=>$v->id])->get()->toArray();
        }
//        dd($class);
        $return = [
            'class' => $class,
        ];
        return view('home.shop.BaihuoMall',$return);
    }

    //商品列表
    public function goodsList(){
        !empty($_REQUEST['type'])?$type=$_REQUEST['type']:'';
        if(!empty($type)){
            $goods = DB::table(self::GOODS)->where(['class_id'=>$type,'status'=>1])->get()->toArray();
            $title = '商品列表';
        }else{
            $goods = DB::table(self::GOODS)->where(['sales_push'=>1,'status'=>1])->get()->toArray();
            $title = '促销专区';
        }

        $return = [
            'goods' => $goods,
            'title' => $title
        ];
        return view('home.shop.goodsList',$return);
    }
}

/**
 * 随机生成订单号
 */
function orderNum(){
    $num = date('Y').date('m').time().rand(1,100);
    $res = DB::table('order')->where(['order_code'=>$num])->first();
    if ($res) {
        orderNum();
    }else{
        return $num;
    }
}

