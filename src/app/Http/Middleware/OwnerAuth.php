<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class OwnerAuth {
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         if (Auth::check()) {
             $user = auth()->user();
             if ($user->userlevel == 'owner') {
                 return $next($request);
             }
         }
         return redirect(route('login'));
     }
}
