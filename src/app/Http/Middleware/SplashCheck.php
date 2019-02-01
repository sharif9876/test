<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Splash;
use Closure;

class SplashCheck {
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
         if(Splash::where(['user_id'=>Auth::user()->id,'path'=>Route::current()->uri()])->first()) {
             Splash::where(['user_id'=>Auth::user()->id,'path'=>Route::current()->uri()])->first()->delete();
             return $next($request);
         }
         return redirect(url('home'));
     }
}
