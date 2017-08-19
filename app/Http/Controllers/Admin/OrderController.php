<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;
use DB;
use App\Http\Model\Order;
use Exception;

class OrderController extends Controller
{
     protected $orderclass;
  
    public function __construct(Order $orderclass)
    {
        $this->orderclass = $orderclass;
    }
  
    #会员列表
    public function index(Request $request){
           
           
            $input=$request->only(['name','phone','start','end','type','status']);
             $query = $this->orderclass->newQuery();

            if($request->has('name'))
                $query->where('name',$input['name']);
            if($request->has('phone')){
                $query->where('phone',$input['phone']);
            }
            if($request->has('start')){
                $start=strtotime($input['start']);
                $query->where('create_at','>=',$start);
            }
             if($request->has('type')){
                
                $query->where('type',$input['type']);
            }
            if($request->has('status')){
                
                $query->where('status',$input['status']);
            }
                
            
            
        $orderclass = $query->select(['*'])->paginate(config('admin.pages'));
            foreach ($orderclass as $key => $value) {
                foreach ($orderclass as $k => $v) {
                        if($v['id']==$value['pid']){
                            $orderclass[$key]['pphone']=$v['phone'];
                        }
                }
                  
            }

        $total=$orderclass->total();//总条数

        $page=ceil($total / config('admin.pages'));//共几页
       
        $currentPage=$orderclass->currentPage();//当前页

        return view('admin.order.index',compact('orderclass','total','page','currentPage'));
    }
    public function edit(Request $request ,$id){

        $res=Order::where('id',$id)->first();   

        return view('admin.order.edit',['res'=>$res]);
    }

    #修改加入物流
    public function editinfo(Request $request){
        $post=$request->input();
        $data=[];
        $data['address']=$post['address'];
        $data['name']=$post['name'];
        $data['phone']=$post['phone'];
        $data['wu']=$post['wu'];
        $data['wuphone']=$post['wuphone'];
        $data['update_at']=time();
        $data['status']=3;

        $order=Order::where('id',$post['id'])->update($data);
        if($order){
            return back()->with('success','请求成功');   
        }else{
            return back()->withErrors('请求失败'); 
        }
    }


    #导出表格
   
    public function export()//用户表的导出
    {
        $data=$this->getUserInfo();
        
        $k=0;
        foreach($data as $v){
            foreach($v as $val){
            
                $data1[$k]['id']=$val['id'];
                $data1[$k]['name']=$val['name'];
                $data1[$k]['phone']=$val['phone'];
                if($val['type'] == 1){
                    $data1[$k]['type'] = '微信';
                }elseif($val['type'] == 2){
                    $data1[$k]['type'] = '支付宝';
                }elseif($val['type'] == 3){
                    $data1[$k]['type'] = '余额';
                }
                $data1[$k]['phone'] = $val['phone'];
                $data1[$k]['price'] = $val['price'];
                $data1[$k]['order_num'] = $val['order_num'];
                if($val['status']==0){
                    $data1[$k]['status']='待付款';
                }elseif($val['status']==1){
                    $data1[$k]['status']='待发货';
                }elseif($val['status']==3){
                    $data1[$k]['status']='已发货';
                }elseif($val['status']==4){
                    $data1[$k]['status']='已收货';
                }elseif($val['status']==5){
                    $data1[$k]['status']='交易完成';
                }else{
                      $data1[$k]['status']='待确认';
                } 

                $data1[$k]['create_at']=date('Y-m-d H:i:s',$val['create_at']);
                                                                     
                $data1[$k]['address']=$val['address'];
             
                $k++;
            }
        }
        $title=array('编号','用户名','收货人手机号','支付类型','订单金额','数量','订单状态','创建时间','收货地址');
        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Type: application/force-download');
        header('Content-Type: application/octet-stream');
        header('Content-Type: application/download');;
        header('Content-Disposition: attachment;filename='.'订单信息表_'.date('Y-m-d',time()).'.xls');//表格文件名
        header('Content-Transfer-Encoding: binary ');
        if (!empty($title)) {
            foreach ($title as $k => $v) {
                $title[$k]=iconv('UTF-8', 'GB2312',$v);//转换编码为utf—8
            }
            $title = implode("\t", $title);//\t空格
            echo $title."\n";//\n为换行//把标题写入表格中
        }
        if (!empty($data)){
            foreach($data1 as $key=>$val){
                foreach ($val as $ck =>$cv) {
                    $data1[$key][$ck]=iconv('UTF-8', 'GB2312', $cv);
                }
                $data1[$key]=implode("\t", $data1[$key]);
            }
            echo implode("\n",$data1);//把数据写入表格中
        }
    }
    public function getUserInfo($first=0,$last=2,&$date='')
        {
            ($data=Order::skip($first)->take($last)->get()) && $data = $data -> toArray();

            if(count($data) > 0){
                $first=$first+2;
                $date[]=$data;
                $this->getUserInfo($first,2,$date);
            }
            return $date;
        }
        
   
  

}
