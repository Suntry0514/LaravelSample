<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HelloMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //リクエスト後の処理(前処理)
        $data = [
            ['name'=>'taro', 'mail'=>'taro@yamada'],
            ['name'=>'hanako', 'mail'=>'hanako@flower'],
            ['name'=>'sachiko', 'mail'=>'sachico@happy'],
        ];
        //mergeはフォームの送信などで送られる値に新たな値を追加する処理。
        //今回はdata_middleという項目で$data_middleの内容が追加される。
        $request->merge(['data_middle'=>$data]);
        return $next($request);
    }
}
