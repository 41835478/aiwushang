<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\User;
use App\Http\Requests\Home\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginController extends BaseController
{
    public function index()//加载注册页面
    {
        return view('home.register.index');
    }

    public function agreement()//注册页面中的用户注册协议
    {
        return view('home.register.agreement');
    }

    public function goRegister(RegisterRequest $request)//添加去注册
    {
        $date=$request->except(['_token','pwd_confirmation','code']);
        $code=$request->only('code')['code'];
        if(Cache::has('registerCode')){
            if($code==Cache::get('registerCode')){
                $date['pwd']=md5($date['pwd']);
                $res=User::insertGetId($date);
                if($res){
                    Cache::forget('registerCode');
                    return $this->ajaxMessage(true,'注册成功',['flag'=>2]);
                }
                return $this->ajaxMessage(false,'注册失败');
            }
            return $this->ajaxMessage(false,'验证码不正确');
        }
        return $this->ajaxMessage(false,'验证码已失效，请重新获取');
    }

    public function sendCode(Request $request)//发送验证码
    {
        if(!Cache::has('registerCode')){
            $res=$this->sendRegisterMsg($request->input('phone'));
            if($res){
                return $this->ajaxMessage(true,'验证码已发送，请注意查收',['flag'=>3]);
            }
            return $this->ajaxMessage(false,'验证码发送失败');
        }
        return $this->ajaxMessage(false,'验证码尚未失效，可以继续使用');
    }

    public function login(Request $request)//执行登录操作
    {
        $date['phone']=$request->input('phone');
        $date['pwd']=md5($request->input('pwd'));
        $res=User::where($date)->first();
        if($res){
            $result=$this->encryptUser($res->id);
            if($result){
                session(['home_user_id'=>$result]);
                return $this->ajaxMessage(true,'登录成功',['flag'=>1]);
            }
        }
        return $this->ajaxMessage(false,'登录失败');
    }
}
