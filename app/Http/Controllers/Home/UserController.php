<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use DB;
use Exception;
class UserController extends Controller
{
    public function index()//加载注册页面
    {

    	var_dump(11);die;
        return view('home.user.index',compact());
    }
}
