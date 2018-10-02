<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\Exceptions\AccessDeniedException;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws AccessDeniedException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = new User();
        $token = $request->header('token');
        $check = $user->where('token', $token)->first();
        if($check->group != 1) {
            throw new AccessDeniedException();
        }

        return $next($request);
    }
}
