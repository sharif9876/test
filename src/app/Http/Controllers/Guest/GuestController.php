<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Option;
use App\User;

class GuestController extends Controller
{
    public function __construct() {

    }

    public function about() {
        $page_text = Option::get('page_about_text');
        return view('guest.about.about', compact('page_text'));
    }

    public function termsOfService() {
        $page_text = Option::get('page_tos_text');
        return view('guest.termsofservice.termsofservice', compact('page_text'));
    }

    public function privacyPolicy() {
        $page_text = Option::get('page_pp_text');
        return view('guest.privacypolicy.privacypolicy', compact('page_text'));
    }

    public function userProfile($id) {
        $user = User::find($id);
        if(!$user) {
            return redirect('/home');
        }
        if($user->points > 0) {
            $bar_width = (($user->points - $user->nextLevel()->points) / ($user->nextLevel()->points - $user->level()->points)) * 100;
        }
        else {
            $bar_width = 0;
        }
        $timeline = $user->timeLine();
        return view('guest.userprofile.userprofile', compact('user', 'bar_width', 'timeline'));

    }
}
