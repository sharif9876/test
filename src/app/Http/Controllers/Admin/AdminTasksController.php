<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Validator;

use App\Task;
use App\TaskType;
use App\TaskEntry;
use App\Splash;
use App\Level;
use App\Question;
use App\TaskRequirement;

class AdminTasksController extends Controller
{
    public function __construct() {
        $this->middleware('admin', ['except' => 'ajaxQuestionAnswerInput']);
    }

    public function tasks() {
        $tasks = Task::all();
        (array) $tasks;

        return view('admin/tasks/tasks', compact('tasks'));
    }

    public function taskEntries() {
        $task_entries = TaskEntry::with('task', 'user')->get();
        (array) $task_entries;

        return view('admin/tasks/taskEntries', compact('task_entries'));
    }

    public function taskAdd() {
        $task_types = TaskType::where('name', 'image')->get();
        $level_max = Level::max('level');
        $errors = session('errors');
        return view('admin/tasks/taskAdd', compact('task_types', 'level_max', 'errors'));
    }

    public function taskEdit($id) {
        $task = Task::find($id);
        $task_types = TaskType::all();
        $level_max = Level::max('id');
        $errors = session('errors');
        return view('admin/tasks/taskEdit', compact('task', 'task_types', 'level_max', 'errors'));
    }

    public function taskDelete($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect('/admin/tasks');
    }

    public function taskAddSave(Request $request) {
        $level_max = Level::max('id');
        $validator = Validator::make($request->all(), [
            'task_title' => 'required|max:191',
            'task_description' => 'required|max:355',
            'task_type' => 'required|in:image',
            'task_level_min' => 'min:0|max:'.$level_max,
            'task_image' => 'file|image'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/tasks/add'))->with('errors', $errors);
        }
        $nextId = Task::max('id')+1;
        if($request->has('task_image')) {
            $task_image = $request->file('task_image');
            $image_name = 'task_'.$nextId;
            $image_extention = $task_image->extension() == 'jpeg' ? '.jpg' : '.'.$task_extention;
            $image_path = public_path('/images/tasks/');
            $task_image->move($image_path, $image_name.$image_extention);
        }
        Task::create([
            'title' => $request->input('task_title'),
            'description' => $request->input('task_description'),
            'type' => $request->input('task_type'),
            'level_min' => $request->has('task_level_min') ? $request->input('task_level_min') : 0,
            //'reward_points' => $request->input('task_reward_points'),
            'background_image_path' => $request->has('task_image') ? $image_name.$image_extention : ''
        ]);
        if($request->has('task_requirements') && !empty($request->input('task_requirements'))) {
            foreach(explode(',', $request->input('task_requirements')) as $requirement) {
                $requirement = explode(':', $requirement);
                TaskRequirement::create([
                    'question_answer' => $requirement[1],
                    'question_id' => $requirement[0],
                    'task_id' => $nextId
                ]);
            }
        }
        return redirect(url('/admin/tasks'));
    }

    public function taskEditSave($id, Request $request) {
        $level_max = Level::max('id');
        $validator = Validator::make($request->all(), [
            'task_title' => 'required|max:191',
            'task_description' => 'required|max:355',
            'task_type' => 'required|in:image',
            'task_level_min' => 'required|min:0|max:'.$level_max,
            'task_image' => 'file|image'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/tasks/'.$id.'/edit'))->with('errors', $errors);
        }
        $task = Task::find($id);
        if($request->has('task_image')) {
            $task_image = $request->file('task_image');
            $image_name = $task->background_image_path;
            $image_extention = $task_image->extension() == 'jpeg' ? '.jpg' : '.'.$task_image->extension();
            $image_path = public_path('/images/tasks/');
            if(File::exists($image_path.$image_name)) {
                File::delete($image_path.$image_name);
            }
            $task_image->move($image_path, 'task_'.$id.$image_extention);
        }
        $task->update([
            'title' => $request->has('task_title') ? $request->input('task_title') : $task->title,
            'description' => $request->has('task_description') ? $request->input('task_description') : $task->description,
            'type' => $request->has('task_type') ? $request->input('task_type') : $task->type,
            'level_min' => $request->has('task_level_min') ? $request->input('task_level_min') : $task->level_min,
            'background_image_path' => $request->has('task_image') ? 'task_'.$id.$image_extention : $task->background_image_path,
        ]);

        return redirect(url('/admin/tasks'));
    }

    public function ajaxTasksFeed(Request $request) {
        if(!$request->ajax()){
            return back();
        }
        $task_entries = TaskEntry::with('task')->with('user')->whereNotIn('id', $request->loaded)->where('status', 'pending')->orderBy('date_submit', 'asc')->get();
        return $task_entries;
    }

    public function ajaxTasksConfirm(Request $request) {
        if(!$request->ajax()){
            return back();
        }
        if($request->action == 'approve') {
            //code for approving a task entry
            if(TaskEntry::find($request->entry_id)) {
                TaskEntry::find($request->entry_id)->update(['status' => 'completed']);
                //splash with task complete
                Splash::create([
                    'type' => 'task_complete',
                    'data' => 'task_id='.$request->entry_id,
                    'path' => 'splash/taskcomplete',
                    'user_id' => Auth::user()->id
                ]);
                //User task complete
                Auth::user()->taskComplete(TaskEntry::find($request->entry_id)->task_id);
            }
            return;
        }
        elseif($request->action == 'decline') {
            //code for declining a task entry
            if(TaskEntry::find($request->entry_id)) {
                TaskEntry::find($request->entry_id)->update(['status' => 'rejected']);
            }
            return;
        }
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

//potentionally add splash_types data table with set paths for ease
