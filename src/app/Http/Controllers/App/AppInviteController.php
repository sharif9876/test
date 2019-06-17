<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Mail\invite;
use Mail;
class AppInviteController extends Controller
{
	public function __construct() {
        $this->middleware('auth');
        $this->middleware('splash');
        $this->middleware('question');
         $this->middleware('points');

    }
    public function invite() {
    	if((Auth::user()->points > 0)and(Auth::user()->nextLevel()!=[])) {
            $bar_width = ((Auth::user()->points - Auth::user()->level()->points) / (Auth::user()->nextLevel()->points - Auth::user()->level()->points)) * 100;
        }
        else {
            $bar_width = 0;
        }
        
     return view('app.invite.invite', compact('bar_width'));
    }

    public function send(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('invite'))->with('errors', $errors);
        }
        $email = $request->input('email');
        Mail::to($email)->send(new invite);
        return redirect(url('invite'));

    }
}
