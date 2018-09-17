<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class supervisor
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
        if (auth()->guest()) {
            return redirect()->route('login');
        } else if (Auth::check() && Auth::user()->role == 'supervisor') {
            return $next($request);
        }

        abort(403);
    }

}
