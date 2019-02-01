<?php

namespace App\Http\Controllers\Questions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Splash;
use App\Task;
use App\Question;

class QuestionsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('questionsCheck');
    }

    public function questions() {
        $question = Question::where('level_min', '<=', Auth::user()->level)->first();
        //return question
        return view('questions.questions', compact('question'));
    }
}
