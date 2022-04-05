<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Validator;
use App\Http\Validators\OriginalValidator;

class HelloServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *アプリケーションが起動する際に割り込んで実行される処理
     * @return void
     */
    public function boot()
    {
        //クロージャーで記載する方法
        view()->composer('provider.index', function ($view) {
            //ビューに変数を追加するためのメソッド
            $view->with('view_message', 'composer message!');
        });

        //クラスで記載する方法
        view()->composer('provider.index', 'App\Http\Composers\HelloComposer');



        //オリジナルのバリデーションルールを記載
        $validator = $this->app['validator']; //おまじない
        //resolver：リゾルブ(バリデーションの処理を行う)の処理を設定する
        $validator->resolver(function (
            $translator,
            $data,
            $rules,
            $messages
        ) {
            //クラスをバリデーションの処理として設定
            return new OriginalValidator(
                $translator,
                $data,
                $rules,
                $messages
            );
        });

        //特定のフォームだけ、カスタマイズしたルールを使用したい場合に使用すr
        Validator::extend('undertwenty', function (
            $attribute,
            $value,
            $parameters,
            $validator
        ) {
            return $value < 20;
        });
    }
}
