<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Validator;
use App\Question;
use App\Level;

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

    public function questionAdd() {
        $level_max = Level::max('level');
        //$answer_types = ['text', 'select', 'multiple', 'num', 'date'];
        $answer_types = ['text', 'select', 'multiple'];
        return view('admin/questions/questionAdd', compact('level_max', 'answer_types'));
    }

    public function questionDelete($id) {
        $question = Question::find($id);
        $question->delete();
        return redirect('/admin/questions');
    }

    public function questionAddSave(Request $request) {
        $level_max = Level::max('level');
        $validator = Validator::make($request->all(), [
            'question_name' => 'required|max:191',
            'question_question' => 'required|max:355',
            'question_level' => 'required|numeric|min:0|max:'.$level_max,
            'question_answer_type' => 'required|in:text,select,multiple',
            'question_image' => 'file|image'
        ]);
        if($validator->fails()) {
            return redirect(url('/admin/questions/add'));
        }
        $nextId = Question::max('id')+1;
        if($request->has('question_image')) {
            $question_image = $request->file('question_image');
            $image_name = 'task_'.$nextId;
            $image_extention = $question_image->extension() == 'jpeg' ? '.jpg' : '.'.$question_extention;
            $image_path = public_path('/images/questions/');
            $question_image->move($image_path, $image_name.$image_extention);
        }
        Question::create([
            'name' => $request->input('question_name'),
            'name_slug' => Str::slug($request->input('question_name')),
            'question' => $request->input('question_question'),
            'answers' => $request->input('question_answers'),
            'answer_type' => $request->input('question_answer_type'),
            'level_min' => $request->input('question_level'),
            'background_image_path' => $request->has('question_image') ? $image_name.$image_extention : ''
        ]);
        return redirect(url('/admin/questions'));
    }
}
