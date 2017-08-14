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
}
