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

class InfoController extends Controller{

    const AD = 'advertisement';
    #项目简介
    public function info(){
        $return = DB::table(self::AD)->where(['type'=>3])->first()?:null;

        return view('home.info.projectBrief',['return'=>$return]);
    }
    #新手必看
    public function newList(){
        $return = DB::table(self::AD)->where(['type'=>4])->select()->get()?:null;

        return view('home.info.BeginnerGuide',['return'=>$return]);
    }
    #必看详情
    public function newInfo(Request $request){
        $id = $request->input('id');
        $return = DB::table(self::AD)->where(['type'=>4,'id'=>$id])->first()?:null;
        return view('home.info.registerRule',['return'=>$return]);
    }
    #系统公告
    public function sysList(){
        $return = DB::table(self::AD)->where(['type'=>2])->select()->get()?:null;
        return view('home.info.SystemNotice',['return'=>$return]);
    }
    #公告详情
    public function sysInfo(Request $request){
        $id = $request->input('id');
        $return = DB::table(self::AD)->where(['type'=>2,'id'=>$id])->first()?:null;
        return view('home.info.NoticeDetails',['return'=>$return]);
    }

}