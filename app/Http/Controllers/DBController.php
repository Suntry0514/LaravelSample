<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//DBクラスを用いた記載方法
class DBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //DBユーザーやパスワードを設定しない場合はenvファイルから環境変数を自動的に読み取りする
        //DBクラスによるデータの取得
        if (isset($request->id)) {
            //DBクラスの書き方
            // $param = ['id' => $request->id];
            // $items = DB::select(
            //     'select * from people where id = :id',
            //     $param
            // );

            //クエリビルダの書き方
            //特定のデータを取り出した場合は、get('id','name')というように記載する
            $items = DB::table('people')->where('id', $request->id)->get();
        } else {
            // DBクラスの書き方
            // $items = DB::select('select * from people');

            //クエリビルダの書き方
            $items = DB::table('people')->get();
        }
        return view('db.index', ['items' => $items]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $id = $request->id;

        $item = DB::table('people')->where('id', $id)->first();

        return view('db/show', ['item' => $item]);
    }

    public function add()
    {
        return view('db.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //バリデーションの設定
        $validate_rule = [
            'name' => 'required',
            'mail' => 'email',
            'age' => 'numeric|between:0,150',
        ];
        $this->validate($request, $validate_rule);

        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        //DBクラス
        //DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);

        //ビルダクエリ
        DB::table('people')->insert($param);
        return redirect('/db');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //DBクラス
        // $param = ['id' => $request->id];
        // $item = DB::select('select * from people where id = :id', $param);
        //return view('db.edit', ['form' => $item[0]]);

        $item = DB::table('people')
            ->where('id', $request->id)->first();
        return view('db.edit', ['form' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $param = [
        //     'id' => $request->id,
        //     'name' => $request->name,
        //     'mail' => $request->mail,
        //     'age' => $request->age,
        // ];
        //DBクラス
        //DB::update('update people set name =:name, mail = :mail, age = :age where id = :id', $param);

        //クエリビルダ
        $param = [
            'name' => $request->name,
            'mail' => $request->mail,
            'age' => $request->age,
        ];
        DB::table('people')->where('id', $request->id)->update($param);

        return redirect('/db');
    }

    public function remove(Request $request)
    {
        // $param = ['id' => $request->id];
        // DB::delete('delete from people where id = :id', $param);

        DB::table('people')->where('id', $request->id)->delete();

        return redirect('/db');
    }
}
