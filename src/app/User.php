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

    public function nextLevel(int $count = null) {
        if($count != null) {
            $level_ids = ($this->level + $count) > Level::max('id') ? range($this->level+1, Level::max('id')) : range($this->level+1, $this->level+$count);
            return level::whereIn('id', $level_ids)->get()->all();
        }
        return Level::find($this->level + 1);
    }

    public function splashes() {
        return $this->hasMany(Splash::class);
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
}
