<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAuth
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
        if($request->ajax()) {    } else {  if(Auth::check()){  $user=Auth::user(); if($user->role == 1) { Auth::logout(); return redirect('login'); } } }
        return $next($request);
    }
}
