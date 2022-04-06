<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HelloAtoMiddleware
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
        //アクション後の処理を記述(後処理)
        //アクション後の処理を受け取る
        $response = $next($request);

        //<middleware></middleware>タグを<a></a>タグに置き換えている
        $content = $response->content();
        $pattern = '/<middleware>(.*)<\/middleware>/i';
        $replace = '<a href="http://$1">$1</a>';
        $content = preg_replace($pattern, $replace, $content);

        $response->setContent($content);
        return $response;
    }
}
