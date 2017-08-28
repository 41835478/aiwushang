<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/23
 * Time: 11:46
 */

namespace App\Http\Services;


use App\Events\RowAEvent;
use App\Events\RowBEvent;
use App\Events\RowCEvent;
use App\Http\Model\Incomerecode;
use App\Http\Model\Order;
use App\Http\Model\Rowa;
use App\Http\Model\Rowb;
use App\Http\Model\Rowc;
use App\Http\Model\Roworder;
use App\Http\Model\User;
use DB;
use Exception;

class RowService
{
    protected $rowA;
    protected $rowB;
    protected $rowC;

    public function __construct(Rowa $rowA,Rowb $rowB,Rowc $rowC)
    {
        $this->rowA=$rowA;
        $this->rowB=$rowB;
        $this->rowC=$rowC;
    }

    public function index($order_id, $type)
    {
        $order = Order::find($order_id);
        if ($type == 3) {//100元专区   说明是A盘
            $this->mainRow($order_id, $order->user_id, $order->order_num, 100, 1,2.5);
        }
        if ($type == 4) {//300元专区   说明是B盘
            $this->mainRow($order_id, $order->user_id, $order->order_num, 300, 2,6.5);
        }
        if ($type == 5) {//2000元专区  说明是C盘
            $this->mainRow($order_id, $order->user_id, $order->order_num, 2000, 3,42.5);
        }
        return false;
    }

    public function RowInfo($row_id,$type)
    {
        if($type==1){
            $row=Rowa::find($row_id);
        }
        if($type==2){
            $row=Rowb::find($row_id);
        }
        if($type==3){
            $row=Rowc::find($row_id);
        }
        $date['prev_id']=$row->prev_id;
        $date['row_id']=$row_id;
        $date['current_level']=$row->current_level ;
        $date['user_id']=$row->user_id;
        return $date;
    }

    public function mainRow($order_id, $user_id, $num, $money, $type,$pointFee)
    {
        if($type==1){
            $mod=$this->rowA;
        }
        if($type==2){
            $mod=$this->rowB;
        }
        if($type==3){
            $mod=$this->rowC;
        }
        for ($j = 0; $j < $num; $j++) {
            $date['order_id'] = $order_id;
            $date['user_id'] = $user_id;
            $date['status'] = 1;
            $date['current_level'] = 1;
            $date['current_generate'] = 1;
            $date['create_at'] = time();
            $res = $mod->insertGetId($date);
            if ($res) {
                $prevId = $mod->where('id', '<', $res)->max('id');
                if ($prevId) {
                    $level = $mod->where(['id' => $prevId])->value('level');//上级的层数
                    $selfLevel = $this->getLevel($mod,$level);
                    $date['prev_id']=$prevId;
                }else{
                    $selfLevel=1;
                }
                $date['update_at'] = time();
                $date['level'] = $selfLevel;
                $res1 = $mod->where(['id' => $res])->update($date);
                if ($res1) {
                    $remark = $money . '元商品区';
                    $res2 = $this->rowOrder($res, $user_id, $remark, $money, $type);
                    if ($res2) {
                        $res3 = $this->getTwentyScore($user_id, $money, $pointFee);//向上20代返钱
                        if($res3){
                            $this->loopUpDisk($res,$type,$order_id);
                        }
                    }
                }
            }
            return false;
        }
    }

    public function loopUpDisk($row_id,$type,$order_id)//开始进盘
    {
        if($type==1){
            $date=$this->RowInfo($row_id,1);
            $date['type']=1;
//            $date['order_id']=$order_id;
//            return $date;
            event(new RowAEvent($date,$order_id));
//            return $this->rowAService->index($date['prev_id'],$date['row_id'],1,$date['user_id'],$date['current_level'],$order_id);
        }
        if($type==2){
            $date=$this->RowInfo($row_id,2);
            $date['type']=2;
//            $date['order_id']=$order_id;
//            return $date;
            event(new RowBEvent($date,$order_id));
//            return $this->rowBService->index($date['prev_id'],$date['row_id'],2,$date['user_id'],$date['current_level'],$order_id);
        }
        if($type==3){
            $date=$this->RowInfo($row_id,3);
            $date['type']=3;
//            $date['order_id']=$order_id;
//            return $date;
            event(new RowCEvent($date,$order_id));
//            return $this->rowCService->index($date['prev_id'],$date['row_id'],3,$date['user_id'],$date['current_level'],$order_id);
        }
    }

    public function getLevel($mod,$level)//获取层数
    {
        $layer = bcpow(2, $level);
        $count = $mod->where(['level' => $level])->count();//这里需要优化
        if ($count < $layer) {
            return $level;
        }
        return $level + 1;
    }

    public function rowOrder($row_id, $user_id, $remark, $money, $type)//向排位订单中插入数据
    {
        $date['user_id'] = $user_id;
        $date['row_id'] = $row_id;
        $date['remark'] = $remark;
        $date['status'] = 1;
        $date['money'] = $money;
        $date['type'] = $type;
        $date['create_at'] = time();
        $res = Roworder::insert($date);
        if ($res) {
            return true;
        }
        return false;
    }

    /**
     * @param $user_id
     * @param int $num
     * @param $money    购买专区的价格
     * @param $award    不同盘给上20代的见点奖
     * @return bool
     */
    public function getTwentyScore($user_id, $money, $award, $num = 1)//得到上二十代用户
    {
        $pid = User::where(['id' => $user_id])->value('pid');
        if ($pid) {
            if ($num <= 20) {
                $res = $this->twentyBonus($user_id, $pid, $money, $award);
                if ($res) {
                    $num++;
                    return $this->getTwentyScore($pid, $money, $award, $num);
                }
            }
        }
        return true;
    }

    public function twentyBonus($user_id, $pid, $money, $award)//二十代奖金
    {
        DB::beginTransaction();
        try {
            $res = User::where(['id' => $pid])->increment('account', $award);
            if ($res) {
                $res1 = User::where(['id' => $pid])->increment('bonus', $award);
                if ($res1) {
                    $from_login_name = User::where(['id' => $user_id])->value('login_name');
                    $to_login_name = User::where(['id' => $pid])->value('login_name');
                    $info = $from_login_name . '购买了' . $money . '元专区的商品' . $to_login_name . '获得推荐奖' . $award . '元';
                    $res2 = $this->incomeRecode($pid, $info, $award, 1, 4, $user_id);
                    if ($res2) {
                        DB::commit();
                        return true;
                    } else {
                        throw new Exception();
                    }
                } else {
                    throw new Exception();
                }
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function incomeRecode($to_user_id, $info, $money, $flag, $type, $from_user_id)//incomerecode表记录信息
    {
        $date['user_id'] = $to_user_id;
        $date['recode_info'] = $info;
        $date['flag'] = $flag;
        $date['money'] = $money;
        $date['status'] = 1;
        $date['type'] = $type;
        $date['from_id'] = $from_user_id;
        $date['create_at'] = time();
        $res = Incomerecode::insert($date);
        if ($res) {
            return true;
        }
        return false;
    }

}