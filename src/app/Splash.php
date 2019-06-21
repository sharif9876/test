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

     public static function getDatas($data){
        $array = explode(',',$data);
        $datas = array();
        foreach ($array as $data ) {
            $temp=explode(':',$data);
            $datas[$temp[0]]=$temp[1];
            
        }
     return $datas;
    }
    
}
