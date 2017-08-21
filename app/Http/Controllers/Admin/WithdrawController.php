<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Withdraw;
use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;

class WithdrawController extends Controller
{
    public function cashList(Request $request)//提现列表
    {
        $query=Withdraw::query();
        if($request->has('mobile'))
            $query->where('mobile',$request->input('mobile'));
        if($request->has('name'))
            $query->where('name','like','%'.$request->input('name').'%');
        $date=$query->paginate(config('admin.pages'));
        $res=$this->paging($date);
        return view('admin.withdraw.cashList',compact('date','res'));
    }
}
