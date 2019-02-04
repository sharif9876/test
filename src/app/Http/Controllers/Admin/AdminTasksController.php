<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Task;
use App\TaskEntry;
use App\Splash;

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

    public function taskAddSave(Request $request) {
        if($request->input('task_title')) {
            //Save image

            Task::create([
                'title' => $request->input('task_title'),
                'description' => $request->input('task_description'),
                'type' => $request->input('task_type'),
                'level_min' => $request->input('task_level_min'),
                'reward_points' => $request->input('task_reward_points'),
                'background_image_path' => '/images/tasks/task'.$request->input('task_title').'.jpg'
            ]);
            $task_image = $request->file('task_image');
            $path = public_path('/images/tasks');
            $image_name = 'task'.$request->input('task_title').'.jpg';
            $task_image->move($path, 'task'.$request->input('task_title').'.jpg');

            return redirect(url('/admin/tasks'));
        }
        return redirect(url('/admin/tasks/add'));
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
