<?php

namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class OriginalValidator extends Validator
{
    //validateOriginalのOriginalの部分がルールを指定する際に記載するルール名。使用する際はoriginalとルール名を記載する
    //使用するには、サービスプロバイダーのbootで定義する必要がある。
    //第1引数：設定したコントロール名、第2引数チェックする値、第３引数：ルール
    public function validateOriginal($attribute, $value, $parameters)
    {
        //入力された値が偶数なる許可
        return $value % 2 == 0;
    }
}
