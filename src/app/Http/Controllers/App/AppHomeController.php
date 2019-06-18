<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Level;
class AppHomeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('splash');
        $this->middleware('question');
        $this->middleware('points');

    }

    public function home() {
       if((Auth::user()->points > 0)and(Auth::user()->nextLevel()!=[])) {
            $bar_width = ((Auth::user()->points - Auth::user()->level()->points) / (Auth::user()->nextLevel()->points - Auth::user()->level()->points)) * 100;
        }
        else {
            $bar_width = 0;
        }
        $levels_next = (array) Auth::user()->nextLevel(3);

        //$levels_next=Level::all();
        $skipped = Auth::user()->skipped;
        if($skipped!=""){
            aaa
        }
        
        return view('app.home.home', compact('bar_width', 'levels_next'));
    }
}
