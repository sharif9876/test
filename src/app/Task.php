<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\TaskType;

class Task extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';
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

    public function type() {
        return TaskType::where('name', $this->type)->first();
    }
}
