<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bladeContrller extends Controller
{
    public function index()
    {
        $data = [
            'msg' => 'これはBladeを利用したサンプルです。',
            'array' => ['one','two','three','four','five']
        ];
        return view('blade.index', $data);
    }

    public function post(Request $request)
    {
        $data = [
            'msg' => $request->msg,
            'test' => '',
            'array' => ['one','two','three','four','five']
        ];
        return view('blade.index', $data);
    }
}
