<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Code;
use App\Splash;
class AppCodeController extends Controller
{
   	public function __construct() {
        $this->middleware('auth');
        $this->middleware('splash');
        $this->middleware('question');
        $this->middleware('points');

    }
     public function code() {
    	 if((Auth::user()->points > 0)and(Auth::user()->nextLevel()!=[])) {
            $bar_width = ((Auth::user()->points - Auth::user()->level()->points) / (Auth::user()->nextLevel()->points - Auth::user()->level()->points)) * 100;
        }
        else {
            $bar_width = 0;
        }
     return view('app.code.code', compact('bar_width'));
    }

    public function send(Request $request){

    	$validator = Validator::make($request->all(), [
            'code' => 'required|exists:codes,code'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('code'))->with('errors', $errors);
        }
       	$code_code = $request->input('code');
        $code=Code::where('code',$code_code)->first();

        
            $points = $code->points;
            $levels = $code->levels;
            $user = Auth::user();
            if(($user->points+$points>0)and($user->level+$levels>0)){
            $user->update(array('points'=>($user->points)+$points,'level'=>($user->level)+$levels));
            Splash::create([
                    'tye' => 'code_used',
                    'data' => 'd',
                    'path' => 'splash/codeused',
                    'user_id' => Auth::user()->id
                ]);
        }
            return redirect(url('code'));
      


    }
     }
