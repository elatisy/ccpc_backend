<?php

/**
 * status:
 * 0:正常
 * -1:已注销
 * 1:锁定
 */
namespace App\Http\Middleware;

use Closure;

class UserMiddleWare
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
