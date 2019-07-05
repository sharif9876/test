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
}
