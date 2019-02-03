<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_info';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['info', 'user_id', 'question_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
