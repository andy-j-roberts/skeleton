<?php

namespace App\Http\Middleware;

use Closure;

class UserHasValidSubscription
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
        if ($request->user() && ! $request->user()->subscribed('essential')) {
            // This user is not a paying customer...
            return redirect('plans');
        }

        return $next($request);
    }
}
