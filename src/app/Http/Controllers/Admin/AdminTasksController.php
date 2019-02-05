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

class AdminTasksController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
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
        return view('admin/tasks/taskAdd');
    }

    public function taskEdit($id) {
        $task = Task::find($id);
        $task_types = TaskType::all();
        return view('admin/tasks/taskEdit', compact('task', 'task_types'));
    }

    public function taskDelete($id) {
        $task = Task::find($id);
        $task->delete();
        return redirect('/admin/tasks');
    }

    public function taskAddSave(Request $request) {
        $task_image = $request->file('task_image');
        $nextId = Task::max('id')+1;
        Task::create([
            'title' => $request->input('task_title'),
            'description' => $request->input('task_description'),
            'type' => $request->input('task_type'),
            'level_min' => $request->input('task_level_min'),
            //'reward_points' => $request->input('task_reward_points'),
            'background_image_path' => '/images/tasks/task_'.$nextId.$task_image->extension()
        ]);

        $path = public_path('/images/tasks');
        $task_image->move($path, 'task_'.$nextId.$task_image->extension());

        return redirect(url('/admin/tasks'));
    }

    public function taskEditSave($id, Request $request) {
        $level_max = Level::max('id');
        $validator = Validator::make($request->all(), [
            'task_title' => 'max:191',
            'task_description' => 'max:355',
            'task_type' => 'in:image',
            'task_level_min' => 'min:0|max:'.$level_max,
            'task_image' => 'file|image'
        ]);
        if($validator->fails()) {
            return redirect(url('/admin/tasks/'.$id.'/edit'));
        }
        $task = Task::find($id);
        if($request->has('task_image')) {
            $task_image = $request->file('task_image');
            $image_name = $task->background_image_path;
            $image_path = public_path('/images/tasks/');
            if(File::exists($image_path.$image_name)) {
                File::delete($image_path.$image_name);
            }
            //$task_image->move($image_path, 'task_'.$id.$task_image->extension());

        }
        $task->update([
            'title' => $request->has('task_title') ? $request->input('task_title') : $task->title,
            'description' => $request->has('task_description') ? $request->input('task_description') : $task->description,
            'type' => $request->has('task_type') ? $request->input('task_type') : $task->type,
            'level_min' => $request->has('task_level_min') ? $request->input('task_level_min') : $task->level_min,
            'background_image_path' => $request->has('task_image') ? '/images/tasks/task_'.$id.$task_image->extension() : $task->background_image_path,
        ]);

        return redirect(url('/admin/tasks'));
    }

    public function ajaxTasksFeed(Request $request) {
        if(!$request->ajax()){
            return back();
        }
        $task_entries = TaskEntry::with('task')->whereNotIn('id', $request->loaded)->where('status', 'ready')->orderBy('date_submit', 'asc')->get();
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
}

//potentionally add splash_types data table with set paths for ease
