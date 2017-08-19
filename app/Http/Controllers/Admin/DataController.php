<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;
use DB;

use Exception;

class DataController extends Controller
{
    public function index(){
        #今日开始时间
        $beginToday=mktime(0,0,0,date('m'),date('d'),date('Y'));
        #今日结束时间
        $endToday=mktime(0,0,0,date('m'),date('d')+1,date('Y'))-1;

        #累计会员总量
        $memberz=DB::table('user')->where('level','>=','1')->count();
        #历史收入累计

        #今日会员总计
         $memberj=DB::table('user')->where('level','>=','1')->whereBetween('create_at',[$beginToday,$endToday])->count();
        #今日订单统计

        #已发放体现金额

        #今日体现总额

        #未消费会员统计

        #1元垫资会员统计

        // var_dump($memberz);die;
        return view('admin.data.index',compact('memberz','memberj'));
    }

}
