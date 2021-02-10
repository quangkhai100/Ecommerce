<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Enums\UserType;

class AdminRole
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
        if (Auth::check() && Auth::user()->level == UserType::ADMINISTRATOR){

            return $next($request);
    } else{

            return redirect()->route('login');
        }
    }
}
