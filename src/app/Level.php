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
    protected $fillable = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function highestRewardTaskAvailable() {
        // CHANGE SO THAT ONLY TASKS NOT ALREADY COMPLETED BY USER GET RETRIEVED
        return Task::where('level_min', $this->id)->orderBy('reward_points', 'desc')->first();
    }
}
