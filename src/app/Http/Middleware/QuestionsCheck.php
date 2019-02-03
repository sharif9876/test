<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Splash;
use App\UserInfo;
use App\Question;
use Closure;

class QuestionsCheck {
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
     {
         foreach(Question::where('level_min', '<=', Auth::user()->level)->get() as $question) {
             if(UserInfo::where(['question_id' => $question->id, 'user_id' => Auth::user()->id])->get()->isEmpty()) {
                 //questions page
                 return $next($request);
             }
         }
         return redirect(url('home'));
     }
}
