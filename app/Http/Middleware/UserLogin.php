<?php

namespace App\Http\Middleware;

use Closure;
use App\Exceptions\ColumnMissingException;
class UserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @throws ColumnMissingException
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->account == null || $request->password == null) {
            throw new ColumnMissingException();
        }

        return $next($request);
    }
}
