<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Model\User;
use App\Http\Model\Pointsrecode;
use App\Http\Model\Incomerecode;
use App\Http\Controllers\Home\BaseController;
use Storage;
use DB;
use Exception;
class UserController  extends BaseController
{
    public function index()//加载注册页面
    {
    	#查询用户信息 
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
   	
    	#查询上级
    
       	$pusers=$t->getuserinfo($users['pid']);
       	
    	#查询团队
    	$pp=$this->wuxian($uid);
    	
    	//var_dump($pp);die;//compact()
        return view('home.user.index',compact('users','pusers'));
    }

   #查询团队
    	public function wuxian($id,$arr=array()){
    		$count = count($arr);
    		$a = User::where('id',$id)->first();
    		$b = User::where('pid',$a['id'])->first();
    		if($b){
    			$arr[$count] = $b['id'];
    			return $this->wuxian($b['id'],$arr);
    		}
    		return $arr;
    	}
/***
*账户信息
*
****/
    #我的账户
    public function myaccount(){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);

    	$saccount=Incomerecode::where('user_id',$uid)->where('flag',1)->get();
    	$zaccount=Incomerecode::where('user_id',$uid)->where('flag',2)->get();

    	return view('home.user.myaccount',compact('users','saccount','zaccount'));
    }
     #余额转账
    public function turnaccount(){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);

    	return view('home.user.turnaccount',compact('users'));
    }
    #提现
    public function withdrawals(){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
    	return view('home.user.withdrawals',compact('users')); 	
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
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
    	$points=$users['repeat_points'];
    	$sintegral=Pointsrecode::where('user_id',$uid)->where('flag',1)->where('sign',1)->get();
    	$zintegral=Pointsrecode::where('user_id',$uid)->where('flag',1)->where('sign',2)->get();

    	//$points=Pointsrecode::where('user_id',$uid)->sum('points');
    	return view('home.user.recastIntegral',compact('sintegral','zintegral','points'));
    }
    #消费积分
    public function consumption(){
     	$uid=$this->checkUser();
     	$t = new User;
    	$users=$t->getuserinfo($uid);
    	$points=$users['consume_points'];
    	$sintegral=Pointsrecode::where('user_id',$uid)->where('flag',2)->where('sign',1)->get();
    	$zintegral=Pointsrecode::where('user_id',$uid)->where('flag',2)->where('sign',2)->get();

    	//$points=Pointsrecode::where('user_id',$uid)->sum('points');   	
    	return view('home.user.consumption',compact('sintegral','zintegral','points'));
    }
	#循环积分
    public function looppoints(){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
    	$points=$users['loop_points'];
    	$sintegral=Pointsrecode::where('user_id',$uid)->where('flag',3)->where('sign',1)->get();
    	$zintegral=Pointsrecode::where('user_id',$uid)->where('flag',3)->where('sign',2)->get();

    	//$points=Pointsrecode::where('user_id',$uid)->sum('points');
    	return view('home.user.looppoints',compact('sintegral','zintegral','points'));
    }

    #积分转账
    public function turnmyintegral(Request $request,$id){
    	$id=$id;
    	$uid=$this->checkUser();
    	$points=Pointsrecode::where('user_id',$uid)->sum('points');
    	return view('home.user.turnmyintegral',compact('points','id'));
    }
    #积分转账提交
    public function editintegral(Request $request){
		 	
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);

    	$post=$request->input();
		
    	if($post['id'] ==''){
    		 return $this->ajaxMessage(false,'参数错误');
    		 // return $this->ajaxMessage(true,'注册成功',['flag'=>2]);
    	}
		
		
    	if($pusers=User::where('phone',$post['phone'])->first()){

		}else{
			return $this->ajaxMessage(false,'该用户不存在');
    	
    	}

    	#id 1 复投 2消费积分
    	if($post['num'] < 50){
    		return $this->ajaxMessage(false,'一次转出积分最少为50积分');
    		
    	}
    	if($post['id']==1){
    		$integralnum=$users['repeat_points'];
    	}elseif($post['id'] ==2){
    		$integralnum=$users['consume_points'];
    	}
    	if($post['num'] < $integralnum){
    		return $this->ajaxMessage(false,'该用户积分不足');
    	}
    	#减少积分，给对方增加积分
    	if($post['id'] == 1){
    		if(	User::where('id',$uid)->decrement('repeat_points', $post['num'])  &&
    			 User::where('phone',$post['phone'])->increment('repeat_points', $post['num'] * 0.95)){
    			$data=[];
    			$data['user_id']=$pusers['id'];
    			$data['flag']=$post['id'];
    			$data['points_info']='转账';
    			$data['sign']=1;
    			$data['points']=$post['num'] * 0.95;
    			Pointsrecode::insert($data);

	   				return $this->ajaxMessage(true,'操作成功',['flag'=>1]);


				}else{
					return $this->ajaxMessage(false,'参数错误');
				}
    	}elseif($post['id']==2){
    		if(	User::where('id',$uid)->decrement('consume_points', $post['num'])  &&
    			User::where('phone',$post['phone'])->increment('consume_points', $post['num'] * 0.95)){
    			$data=[];
    			$data['user_id']=$pusers['id'];
    			$data['flag']=$post['id'];
    			$data['points_info']='转账';
    			$data['sign']=1;
    			$data['points']=$post['num'] * 0.95;
    			Pointsrecode::insert($data);
    				return $this->ajaxMessage(true,'操作成功',['flag'=>1]);

				}else{
					return $this->ajaxMessage(false,'参数错误');
				}
    	}
    	



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
 	public function bonus_jiandian(Request $request ,$id){
 		$uid=$this->checkUser();
 		$t = new User;
    	$users=$t->getuserinfo($uid);
 		# 1 见点 2分销 3推荐 4升级
 		
 		if($id ==''){
			return back()->withErrors('参数错误');
 		}

 		if($id==1){
 			$type=3;
 		}elseif($id==2){
 			$type=1;
 		}elseif($id==3){
 			$type=4;
 		}elseif($id==4){
 			$type=5;
 		}
		$bonus=Incomerecode::where('type',$type)->where('user_id',$uid)->get();
		foreach ($bonus as $key => $value) {
			$bonus[$key]['pic']=$users['pic'];
			$bonus[$key]['name']=$users['name'];
		}
		$zbonus=Incomerecode::where('type',$type)->where('user_id',$uid)->sum('money'); 		
		return view('home.user.bonus_jiandian',compact('bonus','id','zbonus'));
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
