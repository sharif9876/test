<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Carbon\Carbon;  

use App\Message;
use App\MessageEntry;
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
        foreach(Message::where('global',1)->where('level_min', '<=', Auth::user()->level)->get() as $message) {
            if(!MessageEntry::where('user_id',Auth::user()->id)->where('message_id',$message->id)->count()){
                
                MessageEntry::create([
                    'user_id' => Auth::user()->id,
                    'message_id' =>  $message->id
                 ]);
            }
        }
        return $next($request);
    }
}
