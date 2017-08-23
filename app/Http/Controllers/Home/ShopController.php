<?php
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ShopController extends Controller{
    const LUNBO = 'advertisement';
    const GOODS = 'goods';
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
        dd($goods);
    }
}

