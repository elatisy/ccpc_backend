<?php
//TODO:弃用
namespace App\Http\Middleware;

use Closure;

class ImgMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {


        return $next($request);
    }
}
