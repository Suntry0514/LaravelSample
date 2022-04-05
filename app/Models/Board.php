<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $guarded = array('id');

    public static $rules = array(
        'person_id' => 'required',
        'title' => 'required',
        'message' => 'required'
    );

    public function getData()
    {
        return $this->id . ': ' . $this->title . ' ('
            . $this->person->name . ')';
    }

    /**
     *  belongs To結合
     *  　子テーブルから親テーブルの値を取り出す
     *    常に取り出せる値は１つ。（基本的に親テーブルの１つのカラムに１つまたは複数の子テーブルの値が値がぶらさがっている為）
     *  */
    // 新たにメソッドを追加
    public function person()
    {
        return $this->belongsTo('App\Models\Person');
    }
}
