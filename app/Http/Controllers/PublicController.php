<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function ajaxMessage($status, $errorMessage = '', $data = '')
    {
        $result = [
            'status' => $status,
            'message' => $errorMessage,
            'data' => $data
        ];
        return response()->json($result);
    }

    /**
     * @param $request  请求
     * @param $path  文件存放路径
     * @param $pic 提交的文件名
     * @return bool|string
     */
    public function uploadsFile($request,$path,$pic)//文件上传
    {
        $file=$request->file($pic);
        $extensions = ['jpeg','jpg','gif','gpeg','png'];
        if($file->isValid()){
            $ext=$file->getClientOriginalExtension();
            if(in_array(strtolower($ext),$extensions)){
                $fileName=date('YmdHis').'-'.uniqid().'.'.$ext;
                if($file->move($path,$fileName)){
                    return $path.'/'.$fileName;
                }
            }
        }
        return false;
    }
}
