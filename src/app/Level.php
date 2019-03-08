<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Task;

class Level extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'levels';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['level', 'points', 'container_background_image_path', 'container_background_color'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function highestRewardTaskAvailable() {
        // CHANGE SO THAT ONLY TASKS NOT ALREADY COMPLETED BY USER GET RETRIEVED
        // for each available tasks
        // get where no entry available
        //dd(Task::where('level_min', $this->id)->get());
        if(Task::available($this->id)->where('level_min', $this->id)->orderBy('reward_points', 'desc')->count()) {
            return Task::available($this->id)->where('level_min', $this->id)->orderBy('reward_points', 'desc')->first();
        }
        else {
            return Task::available($this->id)->where('level_min', $this->id)->orderBy('reward_points', 'desc')->get();
        }
    }
}
