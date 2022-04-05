<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class templeteController extends Controller
{

    public function index($id='zero'){
        $data = [
            'msg' => 'これはコントローラーから渡されたメッセージです。',
            'id' => $id
        ];
        return view('templete.index', $data);
    }

    public function query(Request $request){
        $data = [
            'msg' => 'これはコントローラーから渡されたメッセージです。',
            'id' => $request->id
        ];
        return view('templete.query', $data);
    }


}
