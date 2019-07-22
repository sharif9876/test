<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use App\Message;
Use App\MessageEntry;

class AppMessagesController extends Controller
{
    public function ajaxMessagesFeed(Request $request ) {
    	if(!$request->ajax()){
            return back();
        }
        $message_entries =  MessageEntry::with('user')->with('message')->whereNotIn('id', $request->loaded)->where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
        return $message_entries;
       

    }
    public function ajaxMessagesUpdate(Request $request ) {
    	if(!$request->ajax()){
            return back();
        }
        MessageEntry::where('user_id',Auth::user()->id)->where('opened',0)->update(['opened'=>1]);
        return ;
       

    }

    public function ajaxMessageDelete(Request $request){
        if(!$request->ajax()){
            return back();
        }
         $types = ['unique-declined'];
        $messageEntry = MessageEntry::find($request->messageEntry);
        $message = Message::find($messageEntry->message_id);
        if(in_array($messageEntry->message->type,$types)){
            
            $messageEntry->delete();
            $message->delete();
            return;
        }else{
            if(Auth::user()->deleted_messages == null){
                Auth::user()->update(['deleted_messages'=>$message->id]);
            }else{

                  Auth::user()->update(['deleted_messages'=>Auth::user()->deleted_messages.','. $message->id]);
            }
            $messageEntry->delete();
            return;
        }


    }
    
}
