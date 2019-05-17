<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'options';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public static function get(string $name) {
        if(Option::where('name', $name)->count()) {
            return Option::where('name', $name)->first()->value;

        }
        else {
            return '';
        }
    }

    public static function set($name, $value) {
        if(Option::where('name', $name)->count()) {
            $option = Option::where('name', $name)->first();
            $option->update([
                'value' => $value
            ]);
        }
        else {
            Option::create([
                'name' => $name,
                'value' => $value
            ]);
        }
    }
}
