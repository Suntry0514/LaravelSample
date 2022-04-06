<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        return view('session.index', ['message_title' => 'セッションページ', 'message'=>'セッションページ']);
    }

    public function ses_get(Request $request)
    {
        //セッションの値を取り出している
        $sesdata = $request->session()->get('msg');
        return view('session.session', ['session_data' => $sesdata]);
    }

    public function ses_put(Request $request)
    {
        //セッションはデフォルトではstorage/frameworkフォルダ内のsettionというファイルに保存される。
        //セッションに関する情報はconfigフォルダ内のsession.phpに保存されている
        //postした時の処理。値を取り出し、セッションに保存している
        $msg = $request->input;
        $request->session()->put('msg', $msg);
        return redirect('session/comfirm');
    }
}
