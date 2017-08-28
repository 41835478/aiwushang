<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;

use App\Http\Model\User;
use App\Http\Model\Pointsrecode;
use App\Http\Model\Incomerecode;
use App\Http\Model\Withdraw;
use App\Http\Model\Payment;
use App\Http\Model\Roworder;
use App\Http\Model\Address;
use App\Http\Model\Order;
use App\Http\Model\Orderinfo;
use App\Http\Model\Goods;
use App\Http\Controllers\Home\BaseController;
//use App\Http\Services\FunctionService;
use Storage;
use DB;
use Cache;
use Exception;
class UserController  extends BaseController
{

	#二维码
	public function qrcode(){

		 return view('home.user.qrcode');
	}



    public function index()//页面
    {
    	#查询用户信息 
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
    	#查询上级
        $pusers=$t->getuserinfo($users['pid']);
    	#查询团队
     	$team=self::wuxian($uid);
    	$count=count($team);

    	//dd($team);
        return view('home.user.index',compact('users','pusers','count'));
    }

   #查询团队
 	public static function wuxian($i){
 		$users = [];
 		($user = User::where(['pid'=>$i]) -> get()) && $user = $user -> toArray();
 		if(count($user) > 0){
 			$users = array_merge($users,$user);
 			foreach ($user as $key => $value) {
 				$tmp = self::wuxian($value['id']);
 				if(count($tmp) > 0 && $tmp != false){
 					$users = array_merge($users,$tmp);
 				}else{
 					continue;
 				}
 			}
 			return $users;
 		}else{
 			return false;
 		}
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
    	#选择银行卡
    public function choosebnak(){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
    	$yinhang=Payment::where('user_id',$uid)->where('type',3)->get();

    	return view('home.user.choosebnak',compact('yinhang','users'));
    }
    #提现
    public function withdrawals(){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);
    	return view('home.user.withdrawals',compact('users')); 	
    }
    #转账提交
    public function editaccount(Request $request){
    	$uid=$this->checkUser();
    	$t = new User;
    	$users=$t->getuserinfo($uid);

    	$post=$request->input();
    	if($post['id']=='' || $post['num']=='' ){
    		return $this->ajaxMessage(false,'参数错误');
    	}
    	if($post['num'] < 50){
    		return $this->ajaxMessage(false,'数量最低为50');
    	}

    	if($post['id'] ==1 ){
    		#转账逻辑处理
    		$puser=User::where('phone',$post['phone'])->first();
    		if($puser){
    			if($post['num'] > $users['account']){
    				return $this->ajaxMessage(false,'账户余额不足');
    			}

#事物开始


    			if(	User::where('id',$uid)->decrement('account', $post['num'])  &&
    					User::where('phone',$post['phone'])->increment('account', $post['num'] * 0.95)){
    			$data=[];
    			$data['user_id']=$puser['id'];
    			$data['type']=2;
    			$data['flag']=2;
    			$data['recode_info']='转账';
    			$data['status']=2;
    			$data['money']=$post['num'] * 0.95;
    			$data['create_at']=time();
    			$data['update_at']=time();
    			$res=Incomerecode::insert($data);
                if($res){

	   				    return $this->ajaxMessage(true,'操作成功',['flag'=>1]);
                    }else{
                        return $this->ajaxMessage(false,'参数错误');
                    }

				}else{
					return $this->ajaxMessage(false,'参数错误');
				}
#事物结束



    		}else{
    			return $this->ajaxMessage(false,'该用户不存在');
    		}

    	}elseif ($post['id']==2) {
    		#提现逻辑处理

    		if($post['num'] > $users['account']){
    				return $this->ajaxMessage(false,'账户余额不足');
    			}

    			#事物开始

    			User::where('id',$uid)->decrement('account', $post['num']);
    				#添加到提现表 百分70
    			$data=[];
    			$data['user_id']=$users['id'];
    			$data['mobile']=$users['phone'];
    			$data['name']=$users['name'];
    			$data['money']=$post['num'];
    			$data['arrival_money']=$post['num'] * 0.70;
    			$data['cash_way']=$post['type'];
    			$data['create_at']=time();
    			$data['update_at']=time();
    			if($post['number']){
    				$data['number']=$post['number'];
    			}
    			Withdraw::insert($data);
    			#添加复投积分 20%
    			$dataf=[];
    			$dataf['user_id']=$users['id'];
    			$dataf['flag']=1;
    			$dataf['points_info']='提现获得';
    			$dataf['sign']=1;
    			$dataf['points']=$post['num'] * 0.20;
    			Pointsrecode::insert($dataf);
    			User::where('id',$users['id'])->increment('repeat_points', $dataf['points']);

    			#添加到消费积分 10%
    			$datax=[];
    			$datax['user_id']=$users['id'];
    			$datax['flag']=2;
    			$datax['points_info']='提现获得';
    			$datax['sign']=1;
    			$datax['points']=$post['num'] * 0.10;
    			Pointsrecode::insert($datax);
    			$res=User::where('id',$users['id'])->increment('consume_points', $datax['points']);
                if($res){
                   return $this->ajaxMessage(true,'操作成功',['flag'=>1]); 
               }else{
                    return $this->ajaxMessage(false,'参数错误');
               }

	   				

	
#事物结束

    	}


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
    	$t = new User;
    	$users=$t->getuserinfo($uid);

    	if($id==1){
    		$points=$users['repeat_points'];
    	}elseif($id ==2){
    		$points=$users['consume_points'];
    	}
    	
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
    	if($post['num'] > $integralnum){
    		return $this->ajaxMessage(false,'该用户积分不足');
    	}
    	#减少积分，给对方增加积分
    	if($post['id'] == 1){
#事物开始

    			$res=User::where('id',$uid)->decrement('repeat_points', $post['num']) ; 
    			$ress=User::where('phone',$post['phone'])->increment('repeat_points', $post['num'] * 0.95);
    			$data=[];
    			$data['user_id']=$pusers['id'];
    			$data['flag']=$post['id'];
    			$data['points_info']='转账';
    			$data['sign']=1;
    			$data['points']=$post['num'] * 0.95;
    			$resss=Pointsrecode::insert($data);
                if($resss){
                    return $this->ajaxMessage(true,'操作成功',['flag'=>1]);
                }
	   			
				

    	}elseif($post['id']==2){

#事物开始

    		if(	User::where('id',$uid)->decrement('consume_points', $post['num'])  &&
    			User::where('phone',$post['phone'])->increment('consume_points', $post['num'] * 0.95)){
    			$data=[];
    			$data['user_id']=$pusers['id'];
    			$data['flag']=$post['id'];
    			$data['points_info']='转账';
    			$data['sign']=1;
    			$data['points']=$post['num'] * 0.95;
    			$res=Pointsrecode::insert($data);
                if($res){
                    return $this->ajaxMessage(true,'操作成功',['flag'=>1]);
                }else{
                    return $this->ajaxMessage(false,'参数错误');
                }
    			

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
		#查询用户信息 
    	$uid=$this->checkUser();
		$roworders=Roworder::where('user_id',$uid)->get();
		return view('home.user.ranking_orders',compact('roworders'));
	}

    /**
*激活会员订单
*/

    #激活订单
    public function activememberorders(){
        #查询用户信息 
        $uid=$this->checkUser();
        $t = new User;
        $users=$t->getuserinfo($uid);

        return view('home.user.activememberorders',compact('users'));
    }
    #激活会员订单
    public function editactivememberorders(Request $request){
        #查询用户信息 
        $uid=$this->checkUser();
        $t = new User;
        $users=$t->getuserinfo($uid);
        $post=$request->input();
        if($post['type']==''){
            return $this->ajaxMessage(false,'参数错误');
        }
        if($post['type']==1){
            $money=100;
        }elseif ($post['type']==2) {
             $money=300;
        }elseif ($post['type']==3) {
              $money=2000;
        }
        if($money > $users['repeat_points']){
            return $this->ajaxMessage(false,'您的复投币不足');
        }
  #事物开始
       

        $res= User::where('id',$uid)->decrement('repeat_points', $money);
        #TODO 接入算法


        if($res){
            return $this->ajaxMessage(true,'提交成功',['flag'=>1]);      
       }else{
            return $this->ajaxMessage(false,'参数错误');
       }
     

         
    }




/**
*团队
*/
	#我的团队
	public function myteam(){
		#查询用户信息 
    	$uid=$this->checkUser();
    	#查询团队
     	$team=self::wuxian($uid);

    	$count=count($team);
     
		return view('home.user.myteam',compact('team','count'));
	}





/****
**账户绑定
*/
	public function accountbinding(){
		$uid=$this->checkUser();
 		$t = new User;
    	$users=$t->getuserinfo($uid);
    	#查询支付宝
    	$zhifu=Payment::where('user_id',$uid)->where('type',2)->first();
    
    		$zhifu= substr_replace($zhifu['number'],'****',3,4);
    	
    	#查询微信
    	$weixin=Payment::where('user_id',$uid)->where('type',1)->first();
    	#查询银行卡
    	$yinhang=Payment::where('user_id',$uid)->where('type',3)->get();


		return view('home.user.accountbinding',compact('zhifu','yinhang','weixin'));
	}
	#添加银行卡
	public function addbank(){

		return view('home.user.addbank');
	}
	#绑定支付宝
	public function bindingaliplay(){
        $uid=$this->checkUser();
        $t = new User;
        $users=$t->getuserinfo($uid);
        $phone=substr_replace($users['phone'],'****',3,4);

		return view('home.user.bindingaliplay',compact('phone'));
	}

	public function editbinding(Request $request){
		$uid=$this->checkUser();
 		$t = new User;
    	$users=$t->getuserinfo($uid);
		$post=$request->input();

		if($post['type']==1){



		}elseif ($post['type']==2){

			if($post['code']==Cache::get('registerCode')){
				if($users['pwd']==md5($post['password'])){
						$data=[];
						$data['type']=2;
						$data['user_id']=$users['id'];
						$data['bankname']=$post['bankname'];
						$data['number']=$post['number'];
						$data['phone']=$post['phone'];
						$data['create_at']=time();
						$data['update_at']=$data['create_at'];
						$res=Payment::insert($data);
						if($res){
							return $this->ajaxMessage(true,'绑定成功',['flag'=>1]);
						}

				}else{
					return $this->ajaxMessage(false,'登录密码错误');
				}	
			}else{
				return $this->ajaxMessage(false,'验证码错误');
			}
			#添加银行卡
		}elseif($post['type']==3){
			$count=Payment::where('user_id',$uid)->where('type',3)->count();
			if($count >= 3){
				return $this->ajaxMessage(false,'每人最多可以绑定三张银行卡');
			}
			$data=[];
			$data['user_id']=$users['id'];
			$data['type']=3;
			$data['bankname']=$post['bankname'];
			$data['bankusername']=$post['bankusername'];
			$data['number']=$post['number'];
			$data['bankaddress']=$post['bankaddress'];
			$data['create_at']=time();
			$data['update_at']=$data['create_at'];
			$re=Payment::insert($data);
			if($re){
				return $this->ajaxMessage(true,'绑定成功',['flag'=>1]);
			}

		}
		

	}
		#删除解绑
	public function bindingdel(Request $request){
		$post=$request->input();
        if($post['jie']=='jie'){
             $res=Payment::where('type',2)->delete();
        }else{
            $res=Payment::where('id',$post['yinhang'])->delete();
        }

		
		if($res){
			return $this->ajaxMessage(true,'操作成功',['flag'=>1]);
		}

	}
/****
*管理收货地址
*
**/	#地址列表
	public function shippingaddress(){
		$uid=$this->checkUser();
		$address=Address::where('user_id',$uid)->get();

		return view('home.user.shippingaddress',compact('address'));

	}
	#管理收货地址
	public function manageaddress(){
		$uid=$this->checkUser();
		$address=Address::where('user_id',$uid)->get();

		return view('home.user.manageaddress',compact('address'));
	}
	#设为默认地址
	public function addressdefault(Request $request){
		$uid=$this->checkUser();
		$post=$request->input();
		if($post['type']==1){
			Address::where('user_id',$uid)->update(['default'=>0]);
			Address::where('id',$post['id'])->update(['default'=>1]);
		}elseif(($post['type']==2)){
			Address::where('id',$post['id'])->delete();
		}
	}
	#添加收货地址页面
	public function toaddress(){
		return view('home.user.toaddress');
	}
	#添加收货地址
	public function editaddress(Request $request){
		$uid=$this->checkUser();
		$post=$request->input();

		$count=Address::where('user_id',$uid)->count();
		if($count > 5){
			return $this->ajaxMessage(false,'最多绑定5个收货地址');
		}

		#定义数组
		$data=[];
		if($post['di']==1){
			Address::where('user_id',$uid)->update(['default'=>0]);

			$data['default']=1;
		}
		$data=[];
		$data['user_id']=$uid;
		$data['name']=$post['name'];
		$data['phone']=$post['phone'];

		$address = $post['demo2'];
        $arr = explode(",",$address); 
        $data['province'] = $arr[0];
        $data['city'] = $arr[1];
        $data['area'] = $arr[2];
        $data['address']=$post['demo'];
        $data['create_at']=time();
        $data['update_at']=$data['create_at'];
        $res=Address::insert($data);
        if($res){
        	return $this->ajaxMessage(true,'绑定成功',['flag'=>1]);
        }

	}


    /*****
    *****用户订单
    ****
    */
    public function userorder(Request $request,$type){
        $uid=$this->checkUser();
        #待付款
        $order_a=self::userorderinfo(1, $uid);
        #待发货
        $order_b=self::userorderinfo(2, $uid);
        #待收货
        $order_c=self::userorderinfo(3, $uid);
        #已收货
        $order_d=self::userorderinfo(4, $uid);
        return view('home.user.userorder',compact('order_d','order_a','order_b','order_c'));
    }

    static function userorderinfo($i,$uid){
       
       
        $list=Order::where('user_id',$uid)->where('status',$i)->orderBy('id','desc')->get();

        foreach ($list as $k => $v) {
            $info=Orderinfo::select('order_id','price','num','name')->where('order_id',$v['id'])->get();
                foreach ($info as $key => $value) {
                    $goods=Goods::select('id','pic','name')->where('id',$value['goods_id'])->first();
                    $info[$key]['name']=$goods['name'];
                    $info[$key]['pic']=$goods['pic'];
                }
                $list[$k]->info = $info;
        }
        return $list;
    }
    #订单详情
    public function userorderin(Request $request,$id){
        $uid=$this->checkUser();
            $list=Order::where('id',$id)->first();

      
            $info=Orderinfo::select('order_id','price','num','name')->where('order_id',$list['id'])->get();
                foreach ($info as $key => $value) {
                    $goods=Goods::select('id','pic','name')->where('id',$value['goods_id'])->first();
                    $info[$key]['name']=$goods['name'];
                    $info[$key]['pic']=$goods['pic'];
                }
                $list->info = $info;
      
        
        return view('home.user.userorderin',compact('list'));
   }
    #订单操作
    public function edituserorder(Request $request){
        $uid=$this->checkUser();
        $post=$request->input();

        #1 取消订单，2提醒发货，3确认收货
        if($post['type']==1){
            $res=Order::where('id',$post['id'])->delete();
            $ress=Orderinfo::where('order_id',$post['id'])->delete();
            if($res && $ress){
                return $this->ajaxMessage(true,'删除成功',['flag'=>1]);
            }else{
                return $this->ajaxMessage(false,'删除失败');
            }

        }elseif ($post['type']==2) {

            $res=Order::where('id',$post['id'])->first();
            if($res['update_at'] + 86400 > time() ){
                 return $this->ajaxMessage(false,'自下单开始，一天之内提醒一次。最多三次');
            }
            if($res['tixin'] > 3){
                 return $this->ajaxMessage(false,'已到达提醒次数');
            }
            $data=[];
            $data['tixin']=$res['tixin'] +1;
            $data['update_at']=time();
            $ress=Order::where('id',$post['id'])->update($data);
            if($ress){
                 return $this->ajaxMessage(true,'提醒成功',['flag'=>1]);
            }
            # code...
        }elseif ($post['type']==3) {
            $data=[];
            $data['status']=4;
            $data['update_at']=time();
            $ress=Order::where('id',$post['id'])->update($data);
            if($ress){
                 return $this->ajaxMessage(true,'操作成功',['flag'=>1]);
            }
        }



    }


    #注销
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('shop/index');
    }
       

}
