<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Task;

class TaskEntry extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_entries';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date_submit', 'status', 'answer', 'user_id', 'task_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
