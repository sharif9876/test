<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\TaskType;
use App\TaskRequirement;
use App\Question;

class Task extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'type', 'level_min', 'reward_points', 'background_image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function type() {
        return TaskType::where('name', $this->type)->first();
    }

    public function scopeLevel($query, $level) {
        return $query->where('level_min', $level);
    }

    public function scopeAvailable($query, $level = null) {
        $ids = [];
        if($level == null) {
            $tasks_left = Auth::user()->tasksLeft();
        }
        else {
            $tasks_left = Auth::user()->tasksLeft($level);
        }
        // dd($tasks_left);
        foreach($tasks_left as $task) {
            if(TaskRequirement::where('task_id', $task->id)->count()) {


                foreach(TaskRequirement::where('task_id', $task->id)->get() as $task_requirement) {
                    if(UserInfo::where('user_id', Auth::user()->id)->where('question_id', $task_requirement->question_id)->count()) {
                        $answer_type = Question::find($task_requirement->question_id)->answer_type;
                        $answers = $task_requirement->question_answer;
                        $user_info = UserInfo::where('user_id', Auth::user()->id)->where('question_id', $task_requirement->question_id)->first()->info;
                        // check if answers match via answer types
                        if($answer_type == 'multiple') {
                            $user_info = explode($user_info, ',');
                            $answers = explode($answers, ',');
                            foreach($answers as $answer) {
                                if(in_array($answer, $user_info)) {
                                    $ids[] = $task->id;
                                }
                            }
                        }
                    }
                }
            }
            else {
                $ids[] = $task->id;
            }
        }
        return $query->whereIn('id', $ids);


    }
}
