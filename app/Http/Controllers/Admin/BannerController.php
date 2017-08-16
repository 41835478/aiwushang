<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Model\Admin\Admin;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Admin\BaseController as Controller;
use Hash;
use Session;

class BannerController extends Controller
{
        #列表页
        public function index()//加载登录视图
        {

            $banner = DB::table('carousel')->get();
            //var_dump($banner);die;
            return view('admin.banner.index', ['banner' => $banner]);
            
        }


        #添加页面
        public function add(){


            return view('admin.banner.add');
        }
        #修改页面
        public function edit(Request $request,$id){

            $banner = DB::table('carousel')->where('id',$id)->first();


            return view('admin.banner.edit',['banner'=>$banner]);
        }
        #提交修改页面
        public function editinfo(Request $request)//执行修改管理员信息操作
        {

            
          // $request->input('id');
         // $request->all();
           //$request->get();
           $require->all();
           $id=$request['id'];
          // $request->only('id','name');
        
          var_dump($id);die;
          
           if ($request->hasFile('image')){
                $date['pic'] = $request->photo->store('image');
            }
            $data['updated_at']=time();
            $banner = DB::table('carousel')->where('id',$id)->update($data);
              if($banner){
                return back()->with('success','修改成功');
            }else{
                return back()->withErrors('修改失败');
            }
        }


        #删除
        public function del(){

            return view('admin.banner.del');
        }
     

  

  
}
