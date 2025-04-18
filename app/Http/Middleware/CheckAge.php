<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Auth;
class CheckAge
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
       $age = Auth::user()->age;
        if($age < 15){
            return redirect()->route('prevent');
        }
        return $next($request);
    }
}
