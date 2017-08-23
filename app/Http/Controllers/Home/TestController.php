<?php

namespace App\Http\Controllers\Home;

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
        dd($this->direct->index(5,1));
    }
}
