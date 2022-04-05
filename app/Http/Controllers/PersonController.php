<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //グローバルスコープを適用しているため、絞り込まれたデータが取得される
        $items = Person::all();
        // return view('person.index', ['items' => $items]);

        //personテーブルとboardテーブルの値の関連付けを持つからむと持たないからむを取得
        $hasItems = Person::has('boards')->get();
        $noItems = Person::doesntHave('boards')->get();
        $param = ['items' => $items, 'hasItems' => $hasItems, 'noItems' => $noItems];
        return view('person.index', $param);
    }


    public function find(Request $request)
    {
        return view('person.find', ['input' => '']);
    }

    public function search(Request $request)
    {
        //findは、idを検索する目のメソッド
        //$item = Person::find($request->input);

        //whereによる検索
        //$item = Person::where('name', $request->input)->first();

        //ローカルスコープによる検索
        //$item = Person::nameEqual($request->input)->first();
        //複数のローカルスコープの組み合わせ
        $min = $request->input * 1;
        $max = $min + 10;
        $item = Person::ageGreaterThan($min)->ageLessThan($max)->first();

        $param = ['input' => $request->input, 'item' => $item];
        return view('person.find', $param);
    }

    public function add(Request $request)
    {
        return view('person.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = new Person;
        $form = $request->all();
        //フォームに追加される非表示フィールドを削除する
        //_tokenはCSRF用非表示フィールドとして用意されている項目
        //テーブルにフィールドはこのようにして削除しておく必要がる
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');

        //以下のようにして１つ１つの項目にセットすることもできる
        //この場合は、ブラウザのタブの固有名とテーブルのフィールド名は一致している必要はない
        // $person = new Person();
        // $person->name = $request->name;
        // $person->mail = $request->mail;
        // $person->age = $request->age;
        // $person->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $person = Person::find($request->id);
        return view('person.edit', ['form' => $person]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, Person::$rules);
        $person = Person::find($request->id);
        $form = $request->all();
        unset($form['_token']);
        $person->fill($form)->save();
        return redirect('/person');
    }


    public function remove(Request $request)
    {
        Person::find($request->id)->delete();
        return redirect('/person');
    }
}
