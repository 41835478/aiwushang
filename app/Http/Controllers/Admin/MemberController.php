<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\PublicController as Controller;
use DB;
use App\Http\Model\User;
use Exception;

class MemberController extends Controller
{
     protected $memberclass;

    public function __construct(User $memberclass)
    {
        $this->memberclass = $memberclass;
    }
  
    #会员列表
    public function index(Request $request){
           
           
            $input=$request->only(['name','phone','start','end','level']);
             $query = $this->memberclass->newQuery();

            if($request->has('name'))
                $query->where('name',$input['name']);
            if($request->has('phone')){
                $query->where('phone',$input['phone']);
            }
            if($request->has('start')){
                $start=strtotime($input['start']);
                $query->where('create_at','>=',$start);
            }
                
            if($request->has('end')){
                 $end=strtotime($input['end']);
                $query->where('create_at','<=',$end);
            }
             if($request->has('level')){
                
                $query->where('level',$input['level']);
            }
            
        $memberclass = $query->select(['*'])->paginate(config('admin.pages'));
            foreach ($memberclass as $key => $value) {
                foreach ($memberclass as $k => $v) {
                        if($v['id']==$value['pid']){
                            $memberclass[$key]['pphone']=$v['phone'];
                        }
                }
                  
            }

        $total=$memberclass->total();//总条数

        $page=ceil($total / config('admin.pages'));//共几页
       
        $currentPage=$memberclass->currentPage();//当前页

        return view('admin.member.index',compact('memberclass','total','page','currentPage'));
    }



    public function edit(Request $request ,$id){
        $res=$this->memberclass->where('id',$id)->first();
       
           $ress=DB::table('user')->where('id',$res['pid'])->select('phone')->first();
       
        return view('admin.member.edit',compact('res','ress')); 
    }
    #修改
    public function editinfo(Request $request){
        $post=$request->input();
        $data=[];
        if($post['phone']){
            $puser=DB::table('user')->where('phone',$post['phone'])->first();
             $data['pid']= $puser->id;
                    if($puser== null){
                         return back()->withErrors('该用户不存在'); 
                    }
        }       
        $data['account']= $post['account'];
        $data['locking']=$post['locking'];
        $data['update_at']=time();
        $banner=DB::table('user')->where('id',$post['id'])->update($data);
    
        if($banner){
           return back()->with('success','请求成功');  
        }else{
            return back()->withErrors('请求失败'); 
        }

    }
    #删除
    public function del(Request $request){

        $id = $request->only('id')['id'];
        $banner=DB::table('user')->where('id',$id)->delete();
        if ($banner) {
            return $this->ajaxMessage(true,'删除成功');
        }else{
            return $this->ajaxMessage(false,'删除失败');
             }

    }

}
