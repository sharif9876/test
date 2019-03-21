<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

use App\Level;
use App\Splash;
use App\Task;
use App\Question;
use App\UserInfo;
use App\TaskEntry;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'provider', 'provider_id' , 'password', 'userlevel', 'level', 'points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userInfo() {
        return $this->hasMany(UserInfo::class);
    }

    public function level() {
        return Level::find($this->level);
    }

    public function splashes() {
        return $this->hasMany(Splash::class);
    }

    public function nextLevel(int $count = null) {
        if($count != null) {
            $level_ids = ($this->level + $count + 1) > Level::max('id') ? range($this->level+2, Level::max('id')) : range($this->level+2, $this->level+$count+1);
            return level::whereIn('id', $level_ids)->get()->all();
        }
        return Level::find($this->level + 1);
    }

    public function taskComplete($task_id) {
        $task = Task::find($task_id);
        $points_new = $this->points + $task->reward_points;
        $this->update(['points' => $points_new]);
        if($this->nextLevel()->points < $this->points) {
            $this->levelUp();
        }
    }

    public function levelUp() {
        if($this->nextLevel()) {
            $this->update(['level' => $this->level+1]);
            Splash::create([
                'tye' => 'level_up',
                'data' => ' ',
                'path' => 'splash/levelup',
                'user_id' => Auth::user()->id
            ]);
        }
        //Cant't get a higher level than current
        return;
    }

    public function questionsLeft($user = null) {
        if($user == null) {
            $user = Auth::user();
        }
        $ids = [];
        foreach(Question::all() as $question) {

            if(!UserInfo::where('user_id', $user->id)->where('question_id', $question->id)->count()) {
                $ids[] = $question->id;
            }
        }
        return Question::whereIn('id', $ids)->get();
    }

    public function tasksLeft() {
        $ids = [];
        foreach(Task::where('level_min', '<=', $this->level+1)->get() as $task) {
            if(!TaskEntry::where('user_id', $this->id)->where('task_id', $task->id)->count()) {
                $ids[] = $task->id;
            }
        }
        return Task::whereIn('id', $ids)->get();
    }

    public function getTasks() {
        return Task::available($this->level)->get();
    }

    public function entriesPending($level = null) {
        if($level == null) {
            return $this::hasMany(TaskEntry::class)->where('status', 'pending');
        }
        else {
            $tasks = Task::where('level_min', $level)->get();
            $ids = [];
            foreach($tasks as $task) {
                $ids[] = $task->id;
            }
            return $this::hasMany(TaskEntry::class)->where('status', 'pending')->whereIn('task_id', $ids);
        }
    }
}
