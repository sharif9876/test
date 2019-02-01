<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Question;

class AdminQuestionsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function questions() {
        $questions = Question::all();
        (array) $questions;

        return view('admin/questions/questions', compact('questions'));
    }
}
