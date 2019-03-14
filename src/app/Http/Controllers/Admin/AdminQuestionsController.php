<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Validator;
use App\Question;
use App\Level;
use App\QuestionRequirement;

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

    public function questionEdit($id) {
        $level_max = Level::max('level');
        $answer_types = ['text', 'select', 'multiple'];
        $question = Question::find($id);
        if($question->answer_type == "select" || $question->answer_type == "multiple") {
            $answers_ = explode(',', $question->answers);
            $answers = [];
            foreach($answers_ as $answer) {
                $answers[] = explode(':', $answer)[0];
            }
        }
        elseif($question->answer_type == "text") {
            $answers = $question->answers;
        }

        return view('admin/questions/questionEdit', compact('level_max', 'answer_types', 'question', 'answers'));
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
        if($request->has('question_requirements') && !empty($request->input('question_requirements'))) {
            foreach(explode(',', $request->input('question_requirements')) as $requirement) {
                $requirement = explode(':', $requirement);
                QuestionRequirement::create([
                    'question_answer' => $requirement[1],
                    'question_answer_id' => $requirement[0],
                    'question_id' => $nextId
                ]);
            }
        }
        return redirect(url('/admin/questions'));
    }

    public function questionEditSave(Request $request, $id) {
        $level_max = Level::max('level');
        $validator = Validator::make($request->all(), [
            'question_name' => 'max:191',
            'question_question' => 'max:355',
            'question_level' => 'numeric|min:0|max:'.$level_max,
            'question_answer_type' => 'in:text,select,multiple',
            'question_image' => 'file|image'
        ]);
        if($validator->fails()) {
            return redirect(url('/admin/questions/edit'));
        }
        $question = Question::find($id);
        if($request->has('question_image')) {
            $question_image = $request->file('question_image');
            $image_name = $task->background_image_path;
            $image_extention = $question_image->extension() == 'jpeg' ? '.jpg' : '.'.$question_image->extension();
            $image_path = public_path('/images/tasks/');
            if(File::exists($image_path.$image_name)) {
                File::delete($image_path.$image_name);
            }
            $question_image->move($image_path, 'task_'.$id.$image_extention);
        }
        $question->update([
            'name' => $request->has('question_name') ? $request->has('question_name') : $question->name,
            'name_slug' => $request->has('question_name') ? Str::slug($request->input('question_name')) : $question->name_slug,
            'question' => $request->has('question_question') ? $request->input('question_question') : $question->question,
            'answers' => $request->has('question_answers') ? $request->input('question_answers') : $question->answers,
            'answer_type' => $request->has('question_answer_type') ? $request->input('question_answer_type') : $question->answer_type,
            'level_min' => $request->has('question_level') ? $request->input('question_level') : $question->level_min,
            'background_image_path' => $request->has('question_image') ? $image_name.$image_extention : $question->background_image_path
        ]);

        return redirect(url('/admin/questions'));
    }

    function ajaxQuestionsIdList(Request $request) {
        if(!$request->ajax()){
            return back();
        }
        return Question::select('id', 'question')->get()->toArray();
    }

    function ajaxQuestionAnswerInput(Request $request) {
        if(!$request->ajax()){
            return back();
        }
        $question = Question::find($request->question_id);
        $html = ' ';
        if($question->answer_type == 'multiple') {
            $html .= '<select class="relation-question-answer">';
            foreach(explode(',', $question->answers) as $answer) {
                $options = explode(':', $answer);
                $html .= '<option value="'.$options[1].'">'.$options[0].'</option>';
            }
            $html .= '</select>';
        }
        else {
            $html .= '<input type="text" name="relation-question-answer" class="relation-question-answer">';
        }
        $res = [$html];
        return $res;
    }
}
