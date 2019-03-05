<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'name_slug', 'question', 'answers', 'answer_type', 'level_min', 'background_image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
