<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class BoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $items = Board::all();
        // return view('board.index', ['items'=> $items]);

        //下記のように記載するとで、personテーブルから値を取得する際のDBへのアクセス回数が少なくなる
        //eagerローディング・・・２つのテーブルの値を１度に取得する。hasOneの時はleftjoin、hasManyの時はwithを使用する
        //https://se-tomo.com/2018/10/08/laravel%E3%81%AEeager%E3%83%AD%E3%83%BC%E3%83%89%E3%81%A8%E3%81%AF/
        $items = Board::with('person')->get();
        return view('board.index', ['items' => $items]);
    }

    public function add(Request $request){
        return view('board.add');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, Board::$rules);
        $board = new Board;
        $form = $request->all();
        unset($form['_token']);
        $board->fill($form)->save();
        return redirect('/board');
    }

    public function rest(Request $request){
        return view('board.rest');
    }
}
