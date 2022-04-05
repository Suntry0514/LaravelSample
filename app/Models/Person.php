<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ScopePerson;

class Person extends Model
{
    use HasFactory;

    /**
     * モデルと関連しているテーブル
     *
     * @var string
     */
    protected $table = 'people';

    //値を用意しておかない項目
    protected $guarded = array('id');

    //フォームからの値に対してのバリデーションルール。
    //基本的にテーブルの値を操作する場合は、フォームのタグの名前とテーブルの項目名は一致していたほうが効率的。
    //そうでなければ、１つ１つテーブルの値はブラウザのタグと紐づける必要がある。
    public static $rules = array(
        'name' => 'required',
        'mail' => 'email',
        'age' => 'integer|min:0|max:150'
    );

    //グローバルスコープ
    protected static function boot()
    {
        parent::boot();

        //直接スコープを記載する
        // static::addGlobalScope('age', function (Builder $builder) {
        //     //Person::all()で取得する際にあらかじめ以下の条件が適用されるようになる。
        //     //$builder->where('age', '>', 20); //直接記載する方法
        // });


        //Scopクラスを用いる
        //static::addGlobalScope(new ScopePerson);
    }

    public function getID(){
        return $this->id;
    }

    public function  getData()
    {
        return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
    }

    //ローカルスコープ 第1引数にはBuilderインスタンスが渡される
    public function scopeNameEqual($query, $str)
    {
        return $query->where('name', $str);
    }

    public function scopeAgeGreaterThan($query, $n)
    {
        return $query->where('age', '>=', $n);
    }

    public function scopeAgeLessThan($query, $n)
    {
        return $query->where('age', '<=', $n);
    }

    /**
     * 第1引数
     * 　結びつける際の、命名規則//結びつける際の、命名規則
     * 　1.親テーブル側の判別カラムが「id」
     * 　※カスタムプライマリーキーでも可
     * 　2.子テーブル側の判別カラムが親テーブル単数名_id
     *
     * 上記の条件が満たされている場合、第２引数、第３引数は省略可能
     *
     * 第２引数　
     * 　外部キーを指定することができる。
     *  親を判別するための値が格納されている、子テーブルのカラム名
     *
     * 第３引数
     * 　ローカルキーを指定することができる
     * 　親を判別する値が格納された親テーブルが持つカラム
     *
     * 第２引数で子テーブルのカラム、第３引数で親テーブルのカラムを指定することで、好きなカラム同士を紐づけることができる
     * また、紐づける条件もつけることができる
     *　https://s-yqual.com/blog/1020
     *
     */
    //boardテーブルとのリレーション hasOne
    //peopleテーブルが主テーブル、boardテーブルが従テーブル
    public function board(){
        //hasOne データが互いに１つずつで結びついている。どちらかが複数になることはない
        return $this->hasOne('App\Models\Board');
    }

    public function boards(){
        //hasMany
        return $this->hasMany('App\Models\Board');
    }
}
