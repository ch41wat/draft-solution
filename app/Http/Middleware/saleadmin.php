<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class saleadmin
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
        } else if (Auth::check() && Auth::user()->role == 'saleadmin') {
            return $next($request);
        } elseif (Auth::check() && Auth::user()->role == 'sale') {
            return redirect('/create/home');
        } elseif (Auth::check() && Auth::user()->role == 'supervisor') {
            return redirect('/index');
        } else {
            return redirect('/admin');
        }
    }

}
