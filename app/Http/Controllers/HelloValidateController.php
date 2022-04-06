<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelloRequest;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelloValidateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Validatorでフォーム以外の値をチェク
        //クエリの値を必須にしている
        $validator = Validator::make($request->query(), [
            'id' => 'required',
            'pass' => 'required',
        ]);

        if ($validator->fails()) {
            $msg = 'クエリーに問題があります。';
        } else {
            $msg = 'ID/PASSを受け付けました。フォームを入力下さい。';
        }

        return view('validate.index', ['msg' => $msg,]);
        //return view('validate.index', ['msg' => '正しく入力されました！']);
    }

    //通常のvalidationの書き方
    // public function post(Request $request)
    // {
    //     $validate_rule = [
    //         'name' => 'required',
    //         'mail' => 'email',
    //     ];
    //     $this->validate($request, $validate_rule);
    //     return view('validate.index', ['msg' => '正しく入力されました！']);
    // }


    //フォームリクエストを用いたvalidationの書き方。HelloRequestでオリジナルのルールを使用している
    public function post(HelloRequest $request)
    {
        return view('validate.index', ['msg' => '正しく入力されました！']);
    }

    //バリデータを使用したチェック
    // public function post(Request $request)
    // {
    //     $messages = [
    //         'name.required' => '名前は必ず入力して下さい。',
    //         'mail.email'  => 'メールアドレスが必要です。',
    //         'age.numeric' => '年齢を整数で記入下さい。',
    //         //'age.between' => '年齢は０～150の間で入力下さい。',
    //         'age.min' => '年齢はゼロ歳以上で記入下さい。',
    //         'age.max' => '年齢は200歳以下で記入下さい。',
    //     ];

    //     //フォームを全てチェックする際は、all()にする。指定したい場合は、配列を作成し引数に渡す
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'mail' => 'email',
    //         'age' => 'numeric'//|between:0,150',
    //     ],$messages);

    //     //条件に応じた追加のルール
    //     //sometimes(項目名、ルール名、クロージャ);
    //     // ※ルール名はあらかじめ用意されたものまたは新たに作成したものを使用。requireなど
    //     //  クロージャは引数からフォームの値を取り出すことができる。戻り値はルールを追加するかどうかを決める真偽値。true：追加しない。false：追加する
    //     $validator->sometimes('age', 'min:0', function($input){
    //         //数値だったら、バリデーションを追加する
    //         return !is_int($input->age);
    //     });
    //     $validator->sometimes('age', 'max:200', function($input){
    //         return !is_int($input->age);
    //     });

    //     if ($validator->fails()) {

    //         return redirect('/validate')
    //             ->withErrors($validator) //Validatorで発生したエラーメッセージをリダイレクト先まで引き継ぐ
    //             ->withInput(); //送信されたフォームをそのまま引き継ぐ
    //     }

    //     return view('validate.index', ['msg' => '正しく入力されました！']);
    // }
}
