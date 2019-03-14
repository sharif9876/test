<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Splash;
use App\UserInfo;
use App\Question;
use App\QuestionRequirement;
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
                 if(!QuestionRequirement::where('question_id', $question->id)->count()) {
                     //questions page
                     return $next($request);
                 }
                 else {
                     $question_requirements = QuestionRequirement::where('question_id', $question->id)->get();
                     foreach($question_requirements as $requirement) {
                         if(UserInfo::where('question_id', $requirement->question_answer_id)->where('user_id', Auth::user()->id)->count()) {
                             $user_info = UserInfo::where('question_id', $requirement->question_answer_id)->where('user_id', Auth::user()->id)->first();
                             if($requirement->question_answer == $user_info->info) {
                                 return $next($request);
                             }
                         }
                     }
                 }
             }
         }
         return redirect(url('home'));
     }
}
