<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/8/24
 * Time: 19:27
 */

namespace App\Http\Services;


class CreateOrderService
{

    public function createOrder()
    {
        return $order_id=1;
    }

    public function order_num()//生成随机订单号
    {
        $code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderCode = $code[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderCode;
    }
}