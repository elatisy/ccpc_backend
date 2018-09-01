<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Exceptions\NeedLogInException;

class TokenMiddleware
{
    /**
     * @var string 用户表
     */
    private $user_table = 'user';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws NeedLogInException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->hasHeader('token')){
            throw new NeedLogInException();
        }

        $token      = $request->header('token');
        $user       = DB::table($this->user_table)->where('token', '=', $token)->first();

        if($user == null){
            throw new NeedLogInException();
        }

        return $next($request);
    }
}
