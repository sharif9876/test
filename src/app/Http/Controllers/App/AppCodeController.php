<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Code;
use App\Splash;
use App\Level;
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
        
        $code=Code::where('code',$request->input('code'))->first();
        
        $user = Auth::user();

        if(($code->active)and(Level::where('level',$code->levels)->first()!=[])){

           $currentLevel=$user->level;
           if($currentLevel<$code->levels){
               $user->update(array('level'=>$code->levels,'points'=>Level::where('level',$code->levels)->first()->points));
                Splash::create([
                        'tye' => 'code_used',
                        'data' => 'level:'.$code->levels.',code:'.$code->code,
                        'path' => 'splash/codeused',
                        'user_id' => Auth::user()->id
                    ]);
                 
             
                $levels=range($currentLevel,$user->level-1);
                foreach($levels as $level){

                    if(($user->skipped=="")and($user->skipped!="0")){

                        $user->update(array('skipped'=>$level));
                    }else{
                       $temp = $user->skipped.",".$level;
                       $user->update(array('skipped'=>$temp));  
                    }

                }

           }
         

          

        }
          
           return redirect(url('code'));
        
      


    }
}
