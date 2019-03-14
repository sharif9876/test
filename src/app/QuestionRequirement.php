<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionRequirement extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'question_requirements';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question_answer', 'question_answer_id', 'question_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
