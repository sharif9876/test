<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class RecentActivity extends Model
{
   /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'recent_activities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'message', 'image_path'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function user(){
    	return $this->belongsTo(User::class)->where('public',1);
    }
    public function convertDate(){
    	$weekDay = Carbon::parse($this->created_at)->format('l');
    	$weekDay = substr($weekDay,0,3);
    	$day = Carbon::parse($this->created_at)->format('jS');
    	$day= substr($day,0,1);
    	$month = Carbon::parse($this->created_at)->format('F');
    	$month= substr($month,0,3);
    	$year = Carbon::parse($this->created_at)->format('Y');
    	$time = $this->created_at;
    	$now = Carbon::now();
    	
    	if(substr($now,0,4)>substr($time,0,4)){
    		$ago = substr($now,0,4)-substr($time,0,4);
    		$word= $ago>1?"years":"year";
    	}else if(substr($now,5,2)>substr($time,5,2)){
    		$ago = substr($now,5,2)-substr($time,5,2);
    		$word= $ago>1?"months":"months";
    	}else if(substr($now,8,2)>substr($time,8,2)){
    		$ago = substr($now,8,2)-substr($time,8,2);
    		$word= $ago>1?"days":"day";
    	}else if(substr($now,11,2)>substr($time,11,2)){
    		$ago = substr($now,11,2)-substr($time,11,2);
    		$word= $ago>1?"hrs":"hr";
    	}else if(substr($now,14,2)>substr($time,14,2)){
    		$ago = substr($now,14,2)-substr($time,14,2);
    		$word= $ago>1?"min":"mins";
    	}else if(substr($now,17,2)>substr($time,17,2)){
    		$ago = substr($now,17,2)-substr($time,17,2);
    		$word= $ago>1?"seconds":"second";
    	}

    	$phrase = $ago.' '.	$word.' ago';
    	return $weekDay.' '.$day.' '.$month.' '.$year.', '.$phrase;
    }

    public function old(){
    	if(substr($this->created_at,8,2)-(substr(Carbon::now(),8,2))<0){
    		return true;
    	}else return false;
    }

}
