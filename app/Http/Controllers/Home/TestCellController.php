<?php

namespace App\Http\Controllers\Home;

use App\Events\Example;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestCellController extends Controller
{
    public function index()
    {
        event(new Example(1));
    }
}
