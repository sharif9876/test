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
