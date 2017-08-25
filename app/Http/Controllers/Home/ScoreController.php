<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 9:38
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Model\User;
use App\Http\Services\AuthService;
use Cache;
class ScoreController extends Controller
{
    /*
    *积分商城
    */
    const GS = 'goods';
    const GC = 'goodsclass';
    const US = 'user';
    #首页
    public  function  index(){
        #查询用户信息
        $auth = new AuthService();
        $uid = $auth->userIdDecrypt(\Session::get('home_user_id'));
        $uid=5;
        $users=DB::table(self::USER)->where(['id'=>$uid])->first();

        return view('home.score.integralMall',['return'=>$return]);
    }
    #商品分类列表
    public  function  lists(){

        return view('home.score.integralMall_list',['return'=>$return]);
    }
    #商品详情
    public  function  info(){

        return view('home.score.goodsDetail_integral',['return'=>$return]);
    }
    #兑换
    public  function  exchange(){

        return view('home.score.integralMall',['return'=>$return]);
    }

}