<?php

namespace App\Http\Controllers\Home;

use App\Http\Services\AuthService;
use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;

class BaseController extends Controller
{
    protected $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth=$auth;
    }

    /**
     * @return string 返回用户的id
     */
    public function checkUser()//用于登录id解密
    {
        $user_id=$this->auth->userIdDecrypt(\Session::get('home_user_id'));
        return $user_id;
    }
}
