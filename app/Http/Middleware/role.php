<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class role {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (auth()->guest()) {
            return redirect()->route('login');
        } else if (Auth::check() && Auth::user()->role == 'admin') {
            return redirect('admin');
        } else if (Auth::check() && Auth::user()->role == 'sale') {
            return redirect('create/home');
        } else if (Auth::check() && Auth::user()->role == 'saleadmin') {
            return redirect('create/home');
        } else if (Auth::check() && Auth::user()->role == 'supervisor') {
            return redirect('create/home');
        } else {
            return redirect('login');
        }
    }

}
