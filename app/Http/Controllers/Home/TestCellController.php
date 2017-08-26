<?php

namespace App\Http\Controllers\Home;

use App\Events\Example;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class TestCellController extends Controller
{
    public function index()
    {
        $date=DB::table('address')->where(['user_id'=>1,'default'=>1])->first();
        foreach($date as $k=>$v){
            dd($v);
        }
//        event(new Example(1));
    }
}
