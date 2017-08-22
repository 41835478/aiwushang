<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index()//加载注册页面
    {
        return view('home.register.index');
    }

    public function agreement()//注册页面中的用户注册协议
    {
        return view('home.register.agreement');
    }
}
