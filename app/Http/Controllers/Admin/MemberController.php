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
                $query->where('create_at','>=',$input['phone']);
            }
                
            if($request->has('end')){
                 $start=strtotime($input['end']);
                $query->where('create_at','<=',$input['phone']);
            }
             if($request->has('level')){
                 $start=strtotime($input['level']);
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
        $page=ceil($total / $memberclass->count());//共几页
        $currentPage=$memberclass->currentPage();//当前页

        return view('admin.member.index',compact('memberclass','total','page','currentPage'));
    }



    public function edit(Request $request ,$id){


        return view('admin.member.edit'); 
    }
    public function editinfo(){

        
    }

}
