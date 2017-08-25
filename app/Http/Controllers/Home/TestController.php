<?php

namespace App\Http\Controllers\Home;

use App\Events\Test;
use App\Http\Model\Rowa;
use App\Http\Services\DirectService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestingController extends Controller
{
    protected $direct;

    public function __construct(DirectService $direct)
    {
        $this->direct=$direct;
    }

    public function index()//测试分销
    {

//        event(new Test(1));
//        dd($this->direct->index(5,1));
    }
}
