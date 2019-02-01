<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Splash extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'splashes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type','data','path','user_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
