<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskEntry;
use App\User;
use App\RecentActivity;
use Auth;

class AppUserProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('splash');
        $this->middleware('question');
        $this->middleware('points');
        $this->middleware('messages');
    }

    public function profile(){
    	return view('app.profile.profile');
    }

    public function recent(){
        $activities =RecentActivity::with(['user' => function($q)  {
                        $q->where('public', 1);
                    }])->get();
            
        return view('app.profile.recent',compact('activities'));
    }
    public function matches(){
        return view('app.profile.matches');
    }
}
