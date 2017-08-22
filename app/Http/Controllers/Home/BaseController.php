<?php

namespace App\Http\Controllers\Home;

use App\Http\Services\AuthService;
use App\Http\Services\SendCodeService;
use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;

class BaseController extends Controller
{
    protected $auth;
    protected $msg;

    public function __construct(AuthService $auth,SendCodeService $msg)
    {
        $this->auth=$auth;
        $this->msg=$msg;
    }

    /**
     * @return string 返回用户的id
     */
    public function checkUser()//用于登录id解密
    {
        return $this->auth->userIdDecrypt(\Session::get('home_user_id'));
    }

    /**
     * @param $id
     * @return string
     */
    public function encryptUser($id)//用于登录id的加密
    {
        return $this->auth->userIdEncrypt($id);
    }

    /**
     * @param $phone
     * @return bool  发送注册短信验证码
     */
    public function sendRegisterMsg($phone)
    {
        return $this->msg->sendMsg($phone);
    }
}
