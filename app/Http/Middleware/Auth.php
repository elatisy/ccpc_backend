<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Exceptions\UserNotExistException;
use App\Exceptions\NeedLoginException;

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
    public function handle($request, Closure $next)
    {
        $token = $request->header('token');
        if($token == null) {
            throw new NeedLoginException();
        }

        $user = new User();
        if($user->where('token', $token)->get() == null) {
            throw new UserNotExistException();
        }

        return $next($request);
    }
}
