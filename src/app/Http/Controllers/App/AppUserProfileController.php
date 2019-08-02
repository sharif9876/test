<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TaskEntry;
use App\User;
use App\RecentActivity;
use Auth;
use Validator;

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
         if((Auth::user()->nextLevel()!=[])) {
            $display_points = Auth::user()->level.' / '.Auth::user()->nextLevel()->points;
            if((Auth::user()->points > 0)){
                $bar_width = ((Auth::user()->points - Auth::user()->level()->points) / (Auth::user()->nextLevel()->points - Auth::user()->level()->points)) * 100;
            }
        }
        else {
            $bar_width = 0;
            $display_points = Auth::user()->points.' / ?';
        }

    	return view('app.profile.profile',compact('bar_width','display_points'));
    }

    public function recent(){
        $activities =RecentActivity::with(['user' => function($q)  {
                        $q->where('public', 1);
                    }])->orderBy('created_at','desc')->get();
            
        return view('app.profile.recent',compact('activities'));
    }

    public function matches(){
        return view('app.profile.matches');
    }

    public function editProfile(){
        $errors = session('errors');
        return view('app.profile.profileEdit',compact('errors'));
    }
    public function editProfileSave(Request $request){
       
        $validator = Validator::make($request->all(), [
            'user_public' => 'required|in:1,0',
            'user_age' => 'int|max:200',
            'user_location' => 'max:200',
            'user_mobile' => 'max:200',
            'user_email' => 'email|max:100',
            'user_bio'=>'max:300'

        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            dd($errors);
            return redirect(url('/profile/edit'))->with('errors', $errors);
        }
        Auth::user()->update([
            'public'=>$request->has('user_public')?$request->input('user_public'):Auth::user()->public,
            'age'=>$request->has('user_age')?$request->input('user_age'):Auth::user()->age,
            'location'=>$request->has('user_location')?$request->input('user_location'):Auth::user()->location,
            'mobile'=>$request->has('user_mobile')?$request->input('user_mobile'):Auth::user()->mobile,
            'email'=>$request->has('user_email')?$request->input('user_email'):Auth::user()->email,
            'bio'=>$request->has('user_bio')?$request->input('user_bio'):Auth::user()->bio,
        ]);
        return redirect(url('/profile'));
    }
}
