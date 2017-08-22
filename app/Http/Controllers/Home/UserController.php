<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\User;
use Storage;
use DB;
use Exception;
class UserController  extends Controller
{
    public function index()//加载注册页面
    {
    	#查询用户信息 

    	#查询上级

    	#查询团队



    	//var_dump(11);die;,compact()
        return view('home.user.index');
    }
/***
*账户信息
*
****/
    #我的账户
    public function myaccount(){

    	return view('home.user.myaccount');
    }

/***
*积分信息
*
**/
    #我的积分
    public function myintegral(){

    	return view('home.user.myintegral');
    }
    #复投积分
    public function recastIntegral(){
    	return view('home.user.recastIntegral');
    }
    #消费积分
    public function consumption(){
    	return view('home.user.consumption');
    }
	#循环积分
    public function looppoints(){
    	return view('home.user.looppoints');
    }

    #积分转账
    public function turnmyintegral(){
    	
    }
 /**
 *奖金信息
 *
 **/
 	#我的奖金
 	public function mybonus(){
 		return view('home.user.mybonus');
 	}
 	#见点奖金
 	public function bonus_jiandian(){
 		return view('home.user.bonus_jiandian');
 	}
 	#分销奖金
 	public function bonus_distribution(){
 		return view('home.user.bonus_distribution');
 	}

 	#推荐奖金
 	public function bonus_recommend(){
 		
 	}
 	#升级奖金
 	public function bonus_upgrade(){
 		
 	}
/**
*排位订单
*/	
	public function ranking_orders(){

		return view('home.user.ranking_orders');
	}

/**
*团队
*/
	#我的团队
	public function myteam(){
		return view('home.user.myteam');
	}

/**
*激活会员订单
*/
	#激活订单
	public function activememberorders(){

		return view('home.user.activememberorders');
	}

/**
*账户绑定
*/
	#绑定支付宝










/**
*我的账户
*/
	#我的账户
	public function accountsettings(){
		return view('home.user.accountsettings');
	}
	#修改登录密码
	public function modify_login(){
		return view('home.user.modify_login');
	}
	#修改支付密码
	public function modify_pay(){
		return view('home.user.modify_pay');
	}
	#修改信息提交
	public function userinfo(){

		//return view('home.user.userinfo');
	}




    #注销
    public function logout(){

    }

}
