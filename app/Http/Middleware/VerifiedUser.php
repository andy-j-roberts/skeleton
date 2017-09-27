<?php

namespace App\Http\Middleware;

use Closure;

class VerifiedUser
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
        if(!auth()->user() || auth()->user()->isVerified())
        {
            return $next($request);
        } else {
            return redirect('/verify-account');
        }
    }
}
