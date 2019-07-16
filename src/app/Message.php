<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MessageEntry;
class Message extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','message','type','data','created_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public static function setGlobal($title, $message, $type, $data){
        $type = 'global-'.$type;
        Message::create([
            'title'=>$title,
            'message'=>$message,
            'type'=>$type,
            'data'=>$data
        ]);


    }
    public static function setUnique($title, $message, $type, $user_id){
        if($type == 'declined'){
            $type = 'unique-declined';
            $message = Message::create([
                'title'=>$title,
                'message'=>$message,
                'type'=>$type
            ]);
        }else{
            if(!Message::where('title', $title)->where('message', $message)->count()){
                    $message = Message::create([
                    'title'=>'Congratulations !',
                    'message'=>'You are on to the next level !',
                    'type'=>'unique-approved'
                ]);
            }else{

                $message = Message::where('title',$title)->where('message',$message)->first();
            }
        } 
        MessageEntry::create([
            'user_id'=>$user_id,
            'message_id'=>$message->id
        ]);

    }

   
    
}
