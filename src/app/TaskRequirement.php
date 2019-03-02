<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskRequirement extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'task_requirements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question_answer', 'question_id', 'task_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
