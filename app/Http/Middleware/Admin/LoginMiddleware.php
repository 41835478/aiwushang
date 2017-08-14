<?php

namespace App\Http\Middleware\Admin;

use App\Http\Model\Admin\Admin;
use Closure;

class LoginMiddleware
{
    protected $admin;

    public function __construct(Admin $admin)
    {
        $this->admin=$admin;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->session()->has('info')){
            $res=$this->getInfo();
            if(!$res){
                return redirect()->with('error','你还没有登录');
            }else{
                return $next($request);
            }
        }else{
            return redirect(url('login/index'))->with('error','亲你还没有登录哦！');
        }
    }

    private function getInfo()
    {
        $res=$this->admin->getDecrypt(session('info'));
        if($res){
            $arr=explode('-',$res);
            $result=$this->admin->where(['mobile'=>$arr[0],'id'=>$arr[1],'status'=>1])->first();
            if($result){
                return true;
            }else{
                return false;
            }
        }else{
            return redirect(url('login/index'))->with('error','亲你还没有登录哦！');
        }
    }
}
