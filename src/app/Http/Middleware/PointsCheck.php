<?php

namespace App\Http\Middleware;

use Closure;
use App\Level;
use App\User;
use Illuminate\Support\Facades\Auth;
class PointsCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
        $user = Auth::user();
        $level_max = Level::max('level');
        $points_max= Level::max('points');
        $user_points = $user->points;
        $user_level = $user->level;
        if($user_level>$level_max) { //If it's over the max, update and go next
            $user->update(array('level'=>$level_max,'points'=>$points_max));
            return $next($request);
        }
        $levelUp = Level::where('level',$user_level+1)->first();
        $level = Level::where('level',$user_level)->first();

        if($levelUp!=null){    
        if($user_points<$levelUp->points){
            if(($user_points<$level->points)){
                $user->update(array('points'=>$level->points));
                 return $next($request);
            }
            }else{
                $levels=Level::whereBetween('points',array(0,$user_points))->get();
                $level = $levels->last();
                $user->update(array('level'=>$level->level));

        }
        }else{
            if($user_points<$level->points){
                $user->update(array('points'=>$level->points));
            }
        }

        

        }
        return $next($request);
    }
}
