<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HelloGlobalMiddleware
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
        $response = $next($request);
        $content = $response->content();
        $pattern = '/<globalmiddleware>(.*)<\/globalmiddleware>/i';
        $replace = 'グローバルミドルウェアで書き換えました';
        $content = preg_replace($pattern, $replace, $content);
        $response->setContent($content);
        return $response;
    }
}
