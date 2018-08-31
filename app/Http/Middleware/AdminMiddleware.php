<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;
use App\Exceptions\PermissionDeniedException;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * @throws PermissionDeniedException
     */
    public function handle($request, Closure $next){

        $token = $request->header('token');

        $group = DB::table('user')->where('token', '=', $token)->first()->group;

        if($group != 'admin'){
            throw new PermissionDeniedException();
        }

        return $next($request);
    }
}
