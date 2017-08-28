<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Incomerecode;
use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;

class DirectController extends Controller
{
    protected $incomeRecode;

    public function __construct(Incomerecode $incomeRecode)
    {
        $this->incomeRecode=$incomeRecode;
    }

    public function index()//分销列表
    {
        $date=$this->incomeRecode->select(['id','user_id','recode_info','money','create_at','from_id'])
            ->where(['flag'=>1,'type'=>1])->paginate(config('admin.pages'));
        foreach($date->items() as $k=>$v){
            $user=$this->getUserInfo($v['user_id']);
            $date->items()[$k]['to_login_name']=$user->login_name;
            $date->items()[$k]['to_sex']=$user->sex;
            $date->items()[$k]['to_phone']=$user->phone;
            $date->items()[$k]['to_pic']=$user->pic;

            $from_user=$this->getUserInfo($v['from_id']);
            $date->items()[$k]['from_login_name']=$from_user->login_name;
            $date->items()[$k]['from_sex']=$from_user->sex;
            $date->items()[$k]['from_phone']=$from_user->phone;
            $date->items()[$k]['from_pic']=$from_user->pic;
        }

        $res=$this->paging($date);
        return view('admin.direct.index',compact('date','res'));
    }

    public function getUserInfo($id)//获取用户信息
    {
        $user=User::find($id);
        return $user;
    }
}
