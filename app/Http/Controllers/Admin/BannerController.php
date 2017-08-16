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
   
    public function index()//加载登录视图
    {

        $banner = DB::table('carousel')->get();
        //var_dump($banner);die;
        return view('admin.banner.index', ['banner' => $banner]);
        
    }
    public function add(){


        return view('admin.banner.add');
    }

    public function edit(Request $request,$id){

        $banner = DB::table('carousel')->where('id',$id)->first();
          if($request->isMethod('post')){
            
            $banner=DB::table('carousel')-where('id',$id)->update();
        }


        return view('admin.banner.edit',['banner'=>$banner]);
    }

    public function del(){

        return view('admin.banner.del');
    }
 

  

  
}
