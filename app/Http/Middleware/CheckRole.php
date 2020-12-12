<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
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
        dd(Auth::user()->hasRole('admin'));
        if(Auth::check()->hasRole('business'))
            return redirect('/business');
        elseif (Auth::user()->hasRole('admin'))
            return redirect('/admin');
        return $next($request);
    }
}
