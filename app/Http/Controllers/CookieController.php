<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CookieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->hasCookie('msgkey')) {
            //保存されているクッキーの値を取得
            $msg = 'Cookie: ' . $request->cookie('msgkey');
        } else {
            $msg = '※クッキーはありません。';
        }
        return view('cookie.index', ['msg' => $msg]);
    }

    public function post(Request $request)
    {
        $validate_rule = [
            'msg' => 'required',
        ];
        $this->validate($request, $validate_rule);
        $msg = $request->msg;
        //postメソッドの引数に(Respose $response)を用意しても、$responseにはviewメソッドは用意されていないため、画面を表示できない。
        //そのため、以下ではnew Responseを行い、Responseインスタンスを作成してviewを呼び出している
        $response = new Response(view('cookie.index', ['msg' =>
        '「' . $msg . '」をクッキーに保存しました。']));

        //クッキーに新たな値を保存する
        $response->cookie('msgkey', $msg, 100);//(キー、値、分数)

        //ここでレスポンスをreturnしないとCookieは保存されない⇨クライアント側に値が渡らないため
        return  $response;
    }
}
