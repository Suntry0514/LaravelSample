<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Myrule;

class HelloRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //フォームリクエストの利用が許可されているかどうかを示す。true：許可、false：不許可＋HttpException例外発生
    //許可は以下の処理内で決める。パスを指定することで、特定のフォームにのみバリデーションをかけることが可能になる
    //バリデーションを記述する際は、コントローラーで宣言(use)する
    //pathはテンプレートファイルのフォーム(<form action="/validate" method="post">)部分のactionと同じである必要がる
    public function authorize()
    {
        //アクセスしたパスがvalidationだったら、trueを返す
        if ($this->path() ==  'validate') {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //適用されるバリデーションの検証ルールを設定
    public function rules()
    {
        return [
            'name' => 'required',
            'mail' => 'email',
            //※numericルールの後に、originalのルールが先に適用される。つまり数値のバリデーションが効いていない
            //Myruleを適用するために、配列にしている
            //Myruleがなければ、'age' => 'numeric|between:0,150|original|undertwenty'　という書き方で良い
            //originalはオリジナルで作成したバリデーションルール
            'age' => ['numeric','between:0,150','original','undertwenty', new Myrule(5)],
        ];
    }

    //エラー時のメッセージをカスタマイズ
    public function messages()
    {
        return [
            'name.required' => '名前は必ず入力して下さい。',
            'mail.email'  => 'メールアドレスが必要です。',
            'age.numeric' => '年齢を整数で記入下さい。',
            'age.between' => '年齢は０～150の間で入力下さい。',
            'age.original' => 'Hello! 入力は偶数のみ受け付けます。',
            'age.undertwenty' => '20未満の値にしてください！'
        ];
    }
}
