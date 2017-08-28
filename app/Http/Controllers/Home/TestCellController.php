<?php

namespace App\Http\Controllers\Home;

use App\Http\Services\DirectService;
//use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use DB;
//use Hash;

class TestCellController extends Controller
{
    protected $directService;

    public function __construct(DirectService $directService)
    {
        $this->directService=$directService;
    }

    public function index()
    {
        dd($this->directService->main(1));
//        event(new Example(1));
    }
}
