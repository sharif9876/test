<?php

namespace App\Http\Controllers\Splash;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Splash;
use App\Task;

class SplashController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('splashCheck');
      
    }

    public function levelUp() {
        return view('splash.levelUp');
    }

    public function taskComplete() {
        return view('splash.taskComplete');
    }

    public function codeUsed(){

        return view('splash.codeUsed');
    }
}
