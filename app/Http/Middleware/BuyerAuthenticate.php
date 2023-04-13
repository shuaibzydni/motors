<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BuyerAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = 'buyers_web')
    {
        if(!auth()->guard($guard)->check()) {
            return redirect(route('buyer.login'));
        }
        return $next($request);
    }
}
