<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Level;
use App\MessageEntry;

class AppHomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('splash');
        $this->middleware('question');
        $this->middleware('points');
        $this->middleware('messages');
    }

    public function home() {
         $message_entries =  MessageEntry::with('user')->with('message')->where('user_id',Auth::user()->id)->orderBy('created_at', 'asc')->get();
       
       if((Auth::user()->points > 0)and(Auth::user()->nextLevel()!=[])) {
            $bar_width = ((Auth::user()->points - Auth::user()->level()->points) / (Auth::user()->nextLevel()->points - Auth::user()->level()->points)) * 100;
        }
        else {
            $bar_width = 0;
        }
        $levels_next = (array) Auth::user()->nextLevel(10);
        $levels_previous = (array) Auth::user()->previousLevel(10);

        $arraySkipped = array();

        if(Auth::user()->skipped!=""){
            
            $arraySkipped = explode(',',Auth::user()->skipped);
            
        }
        
        return view('app.home.home', compact('bar_width', 'levels_next','arraySkipped','levels_previous'));
    }
}
