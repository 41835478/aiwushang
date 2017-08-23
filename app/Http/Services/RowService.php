<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 11:46
 */

namespace App\Http\Services;


use App\Http\Model\Incomerecode;
use App\Http\Model\Order;
use App\Http\Model\Rowa;
use App\Http\Model\User;
use DB;
use Exception;

class RowService
{
    public function index($order_id,$type)
    {
        $order=Order::find($order_id);
        if($type==3){//100元专区   说明是A盘

            $this->mainRowA($order_id,$order->user_id);
        }
        if($type==4){//300元专区   说明是B盘

        }
        if($type==5){//2000元专区  说明是C盘

        }
    }

    public function mainRowA($order_id,$user_id)
    {
        $date['order_id']=$order_id;
        $date['user_id']=$user_id;
        $date['status']=1;
        $date['current_level']=1;
        $date['current_generate']=1;
        $date['create_at']=time();
        $res=Rowa::insertGetId($date);
        if($res){
            $prevId = Rowa::where('id', '<', $res)->max('id');
            if($prevId){
                $level=Rowa::where(['id'=>$prevId])->value('level');//上级的层数
                $selfLevel=$this->getLevel($level);
                $date['update_at']=time();
                $date['level']=$selfLevel;
                $res1=Rowa::where(['id'=>$res])->update($date);
                if(!$res1){
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    public function getLevel($level)//获取层数
    {
        $layer=bcpow(2,$level);
        $count=Rowa::where(['level'=>$level])->count();//这里需要优化
        if($count<$layer){
            return $level;
        }
        return $level+1;
    }

    /**
     * @param $user_id
     * @param int $num
     * @param $money    购买专区的价格
     * @param $award    不同盘给上20代的见点奖
     * @return bool
     */
    public function getTwentyScore($user_id,$num=1,$money,$award)//得到上二十代用户
    {
        $pid=User::where(['id'=>$user_id])->value('pid');
        if($pid){
            if($num<=20){
                $res=$this->twentyBonus($user_id,$pid,$money,$award);
                if($res){
                    $num++;
                    return $this->getTwentyScore($pid,$num,$money,$award);
                }
            }
        }
        return true;
    }

    public function twentyBonus($user_id,$pid,$money,$award)//二十代奖金
    {
        DB::beginTransaction();
        try{
            $res=User::where(['id'=>$pid])->increment('account',$award);
            if($res){
                $res1=User::where(['id'=>$pid])->increment('bonus',$award);
                if($res1){
                    $from_login_name=User::where(['id'=>$user_id])->value('login_name');
                    $to_login_name=User::where(['id'=>$pid])->value('login_name');
                    $info=$from_login_name.'购买了'.$money.'元专区的商品'.$to_login_name.'获得推荐奖'.$award.'元';
                    $res2=$this->incomeRecode($pid,$info,$award,1,4,$user_id);
                    if($res2){
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
        }catch(Exception $e){
            DB::rollBack();
            return false;
        }
    }

    public function incomeRecode($to_user_id,$info,$money,$flag,$type,$from_user_id)//incomerecode表记录信息
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