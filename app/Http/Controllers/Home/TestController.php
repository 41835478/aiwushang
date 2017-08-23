<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Rowa;
use App\Http\Services\DirectService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    protected $direct;

    public function __construct(DirectService $direct)
    {
        $this->direct=$direct;
    }

    public function index()//测试分销
    {
        $i = 1;
        $a=2;
        $num=48;
        while ($i)
        {
            $a=$a*2;
            if($a<=$num){
                $i++;
            }else{
                break;
            }
        }
        echo $i;
//        dd($this->direct->index(5,1));
    }
}
