<?php

namespace App\Http\Model\Home;

use Illuminate\Database\Eloquent\Model;
use Exception;

class Direct extends Model
{
    //$order_id 订单id   $type 1、爱无尚商城 2、合作平台 3、100元专区 4、300元专区 5、2000元专区
    public function index($order_id,$type)
    {
        if($type==1||$type==2){//要进行分佣
            return $this->main($order_id);
        }elseif($type==3||$type==4||$type==5){//要进行排位

        }
    }

    public function main($order_id)//分佣主函数
    {
        $order=Order::find($order_id);
        $pid=User::where(['id'=>$order->user_id])->first(['pid']);
        return $this->goSale($order->user_id,$pid,$order->total_money);
    }

    public function goSale($user_id,$pid,$money,$rate1=0.1,$rate2=0.2,$num=1)//递归去分佣
    {
        $find=User::where(['id'=>$pid])->first(['pid']);
        if($find){
            if($num<=2){
                $bonus=0;
                if($num==1){
                    $bonus=$rate1*$money;
                }
                if($num==2){
                    $bonus=$rate2*$money;
                }
                $res=$this->mainIncome($user_id,$pid,$bonus,$money);
                if($res){
                    $num++;
                    return $this->goSale($user_id,$find->pid,$money,$rate1=0.1,$rate2=0.2,$num);
                }
                return false;
            }
        }
        return true;
    }

    public function mainIncome($current_id,$prev_id,$bonus,$money)//分佣记录主函数
    {
        DB::beginTransaction();
        try{
            $res1=User::where(['id'=>$prev_id])->increment('account',$bonus);
            if($res1){
                $res2=User::where(['id'=>$prev_id])->increment('bonus',$bonus);
                if($res2){
                    $res3=User::where(['id'=>$prev_id])->increment('repeat_points',$money);
                    if($res3){
                        $from_login_name=User::where(['id'=>$current_id])->value('login_name');
                        $to_login_name=User::where(['id'=>$prev_id])->value('login_name');
                        $info=$from_login_name.'向上级'.$to_login_name.'返分销额'.$bonus.'元';
                        $res4=$this->recodeInfo($prev_id,$info,$bonus,1,1,$current_id);
                        if($res4){
                            DB::commit();
                            return true;
                        }else{
                            throw new Exception();
                        }
                    }else{
                        throw new Exception();
                    }
                }else{
                    throw new Exception();
                }
            }else{
                throw new Exception();
            }
        }catch(Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function recodeInfo($to_user_id,$info,$money,$flag,$type,$from_user_id)//记录信息
    {
        $date['user_id']=$to_user_id;
        $date['recode_info']=$info;
        $date['flag']=$flag;
        $date['money']=$money;
        $date['status']=1;
        $date['type']=$type;
        $date['from_id']=$from_user_id;
        $date['create_at']=time();
        $res=Incomerecode::insert($date);
        if($res){
            return true;
        }
        return false;
    }
}
