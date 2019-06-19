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
        Splash::where(['user_id'=>Auth::user()->id,'path'=>Route::current()->uri()])->first()->delete();
        return view('splash.levelUp');
    }

    public function taskComplete() {
        Splash::where(['user_id'=>Auth::user()->id,'path'=>Route::current()->uri()])->first()->delete();
        return view('splash.taskComplete');
    }

    public function codeUsed(){
        $data =  Splash::where(['user_id'=>Auth::user()->id,'path'=>Route::current()->uri()])->first()->data;
        $datas = Splash::getDatas($data);
        
        Splash::where(['user_id'=>Auth::user()->id,'path'=>Route::current()->uri()])->first()->delete();
        return view('splash.codeUsed',compact('datas'));
    }
}
