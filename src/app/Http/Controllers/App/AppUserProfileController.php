<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        return view('app.profile.recent');
    }
    public function matches(){
        return view('app.profile.matches');
    }
}
