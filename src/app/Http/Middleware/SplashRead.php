<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class SplashRead {
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         // Splash Screens
         if(Auth::user()->splashes->first()) {
             $splash = Auth::user()->splashes->first();
             return redirect(url($splash->path));
         }
        return $next($request);
     }
}
