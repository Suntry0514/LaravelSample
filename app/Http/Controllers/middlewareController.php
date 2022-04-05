<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class middlewareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //リクエスト後のmiddlewareでの処理後のデータを受け取る
        $reqdata = $request -> data_middle;

        $data = [
            ['name' => '山田たろう', 'mail' => 'taro@yamada'],
            ['name' => '田中はなこ', 'mail' => 'hanako@flower'],
            ['name' => '鈴木さちこ', 'mail' => 'sachico@happy']
        ];
        $mergeData = array_merge($reqdata, $data);
        //前処理の時の記述方法
        return view('middleware.index', ['array' => $mergeData]);

    }
}
