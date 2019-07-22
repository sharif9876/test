<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;  

use App\Message;
use App\MessageEntry;
use App\User;

class MessageRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        foreach(Message::where('type','like','global%')->whereNotIn('id', Auth::user()->getMessageEntries())->get() as $message) {
            $entry = false;
            $type = explode('-',$message->type)[1];
            if($type=='date'){
                if(Carbon::now()>$message->data){
                    $entry = true;
                     
                }
            }else{
                if(Auth::user()->level>=$message->data){
                    $entry = true;

                }
            }
            if(($entry)and (!in_array($message->id,explode(',',Auth::user()->deleted_messages)))){
               
                MessageEntry::create([
                    'user_id' => Auth::user()->id,
                    'message_id' =>  $message->id
                ]);
            }
            
        }
        return $next($request);
    }
}
