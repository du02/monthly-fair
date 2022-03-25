<?php

namespace App\Http\Middleware;

use App\Fair;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AccessProducts
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
