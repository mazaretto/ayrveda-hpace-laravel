<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class VerifiedUser extends Middleware
{
    public function handle($request, Closure $next, ...$guards)
    {
        if(auth()->check()){
            if (!auth()->user()->active){
                auth()->logout();

                return redirect()->route('login.doctor')->with('message', trans('auth.not_verified'));
            }
        }

        return $next($request);
    }
}
