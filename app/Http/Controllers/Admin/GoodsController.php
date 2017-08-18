<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Goods;
use App\Http\Model\Goodsclass;
use App\Http\Requests\Admin\GoodsAreaRequest;
use App\Http\Requests\Admin\GoodsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;
use Illuminate\Support\Facades\Input;

class GoodsController extends Controller
{
    protected $goods;

    public function __construct(Goods $goods)
    {
        $this->goods=$goods;
    }

    public function index($mark=1)//加载添加商品视图
    {
        $flag=$mark;
        return view('admin.goods.index',compact('flag'));
    }

    public function getGoodsClass(Request $request)//获取商品分类
    {
        $data='';
        $date=$request->only(['type','id']);
        $data=$this->goodsClass($date);
        return $this->ajaxMessage(true,'获取数据成功',$data);
    }

    public function addGoods(GoodsRequest $request)//执行添加商品操作
    {
        $date=$request->except(['_token','pic','small_pic']);
        $res=$this->goodsCommon($date,$request,1);
        if ($res) {
            return redirect(url('goods/index',array('mark'=>1)))->with('success','添加商品成功');
        } else {
            return back()->with('error','添加商品失败');
        }
    }

    public function actGoodsArea(GoodsAreaRequest $request)//执行添加专区商品操作
    {
        $date=$request->except(['_token','pic','small_pic']);
        $res=$this->goodsCommon($date,$request,2);
        if ($res) {
            return redirect(url('goods/index',array('mark'=>2)))->with('success','添加商品成功');
        } else {
            return back()->with('error','添加商品失败');
        }
    }

    public function goodsCommon($date,$request,$flag)//添加商品公共函数
    {
        $mod = $this->goods;
        $data=array();
        if($flag==1){
            if($request->has('goodsType')){
                foreach($date['goodsType'] as $v){
                    if($v==1){
                        $data['hots']=1;
                    }
                    if($v==2){
                        $data['sales_push']=1;
                    }
                }
                unset($date['goodsType']);
            }
        }else{
            if($date['goodsArea']==4){
                $data['price']=100;
            }
            if($date['goodsArea']==5){
                $data['price']=300;
            }
            if($date['goodsArea']==6){
                $data['price']=2000;
            }
            $data['type']=$date['goodsArea'];
            unset($date['goodsArea']);
        }
        foreach($date as $k=>$v){
            $data[$k]=$v;
        }
        if($request->hasFile('pic')){
            $path = $this->uploadsFile($request, 'uploads/goods/main_pic', 'pic');
            if ($path) {
                $data['pic'] = $path;
            } else {
                return back()->withErrors('上传商品主图失败');
            }
        }else{
            return back()->withErrors('请上传商品主图');
        }
        if($request->hasFile('small_pic')){
            $files=$request->file('small_pic');
            foreach($files as $file){
                $ext=$file->getClientOriginalExtension();
                $fileName=date('YmdHis').'-'.uniqid().'.'.$ext;
                if($file->move('uploads/goods/small_pic',$fileName)){
                    $arr[]='uploads/goods/small_pic/'.$fileName;
                }else{
                    return back()->withErrors('上传商品轮播图失败');
                }
            }
            $data['small_pic']=json_encode($arr);
        }else{
            return back()->withErrors('请上传商品轮播图');
        }
        $data['create_at']=time();
        $res=$mod->insert($data);
        if ($res) {
            return true;
        }
        return false;
    }

    public function goodsList(Request $request)//加载商品列表视图
    {
        $date=$this->goods->whereIn('type',[1,2,3])->where(function($query) use ($request){
            if($request->has('name'))
                $query->orWhere('name','like','%'.$request->input('name').'%');
            if($request->has('goodsType')){
                $goodsType=Input::get('goodsType');
                if($goodsType==1){//说明是热门推荐
                    $query->orWhere(['hots'=>$goodsType]);
                }else{
                    $query->orWhere(['sales_push'=>$goodsType]);
                }
            }
            if($request->has('classType'))
                $query->orWhere(['type'=>$request->input('classType')]);
            if($request->has('nextName'))
                $query->orWhere(['class_id'=>Input::get('nextName')]);
        })->paginate(config('admin.pages'));
        dd($date);
        foreach($date->items() as $k=>$v){
            $date->items()[$k]['class_name']=$this->getClass($v['class_id']);
            $date->items()[$k]['small_pic']=json_decode($v['small_pic'],true);
        }
        $goodsClass=Goodsclass::select(['id','name'])->where(['pid'=>0])->get();
        $res=$this->paging($date);//分页信息
        return view('admin.goods.goodsList',compact('date','res','goodsClass'));
    }

    public function getClass($id)
    {
        $find=Goodsclass::find($id);
        return $find->name;
    }

    public function goodsAreaList()//加载专区商品列表
    {
        $date=$this->goods
            ->select(['id','name','pic','small_pic','title','money','price','storage','sale','status'])
            ->whereIn('type',[4,5,6])->paginate(config('admin.pages'));
        
    }

    public function getInputForm(Request $request)//获取input表单
    {
        $flag=$request->input('type');
        if($flag==3){//说明是积分商城
            $str=<<<Fol
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品消费积分</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="integral" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>               
Fol;
        }else{
            $str=<<<Eol
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品价格</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="price" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">商品市场价</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="money" value="">
                    </div>
                </div>
                <div class="hr-line-dashed"></div>

Eol;
        }
        return $this->ajaxMessage(true,'获取数据成功',$str);
    }
}
