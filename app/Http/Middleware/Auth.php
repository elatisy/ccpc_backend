<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Exceptions\UserNotExistException;
use App\Exceptions\NeedLoginException;
//use http\Env\Request;
use Illuminate\Http\Request;

class Auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        dd($request);
        $token = $request->header('token');
        if($token == null) {
            throw new NeedLoginException();
        }

        $user = new User();
        if($user->where('token', $token)->first() == null) {
            throw new UserNotExistException();
        }

        return $next($request);
    }
}
