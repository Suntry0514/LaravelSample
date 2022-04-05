<?php

namespace App\Http\Validators;

use Illuminate\Validation\Validator;

class OriginalValidator extends Validator
{
    //validateOriginalのOriginalの部分がルールを指定する際に記載するルール名。使用する際はoriginalとルール名を記載する
    //使用するには、サービスプロバイダーのbootで定義する必要がある。
    public function validateOriginal($attribute, $value, $parameters)
    {
        //入力された値が偶数なる許可
        return $value % 2 == 0;
    }
}
