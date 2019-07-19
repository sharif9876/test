<?php

namespace App\Http\Controllers\Questions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Splash;
use App\Task;
use App\Question;
use App\UserInfo;
use App\QuestionRequirement;

class QuestionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('questionsCheck');
    }

    public function questions() {

        //$questions_with_requirements = Question::where('level_min','<=',Auth::user()->level)->where('id',QuestionRequirement::where('question_id','>',0)->pluck('id')->toArray());

        foreach(Question::where('level_min', '<=', Auth::user()->level)->get() as $question_info) {
                  
             if(UserInfo::where('question_id', $question_info->id)->where('user_id', Auth::user()->id)->get()->isEmpty()) {
                 if(!QuestionRequirement::where('question_id', $question_info->id)->count()) {
                    
                     $question = Question::find($question_info->id);
                 }
                 else {
                     $question_requirements = QuestionRequirement::where('question_id', $question_info->id)->get();
                     foreach($question_requirements as $requirement) {
                         if(UserInfo::where('question_id', $requirement->question_answer_id)->where('user_id', Auth::user()->id)->count()) {
                             $user_info = UserInfo::where('question_id', $requirement->question_answer_id)->where('user_id', Auth::user()->id)->first();
                             if($requirement->question_answer == $user_info->info) {
                                
                                $question = Question::find($question_info->id);
                             }
                         }
                     }
                 }

             }
         }

        if($question->answer_type == "select") {
            $answer_options = explode(',', $question->answers);
            $answers = [];
            foreach($answer_options as $option) {
                $options = explode(':', $option);
                array_push($answers, [$options[0],$options[1]]);
            }
        }
        elseif($question->answer_type == "multiple") {
            $answer_options = explode(',', $question->answers);
            $answers = [];
            foreach($answer_options as $option) {
                $options = explode(':', $option);
                array_push($answers, [$options[0],$options[1]]);
            }
        }
        //return question
        return view('questions.questions', compact('question', 'answers'));
    }

    public function questionSubmit(Request $request) {
        $question = Question::where('level_min', '<=', Auth::user()->level)->first();

        $answer = $request->input('question-answer');
        $question_id = $request->input('question-id');

        UserInfo::create([
            'info' => $answer,
            'user_id' => Auth::user()->id,
            'question_id' => $question_id
        ]);

        return redirect(url('questions'));
    }
}
