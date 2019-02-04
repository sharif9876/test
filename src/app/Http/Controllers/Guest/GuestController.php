<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GuestController extends Controller
{
    public function __construct() {

    }

    public function termsOfService() {
        return view('guest.termsofservice.termsofservice');
    }

    public function privacyPolicy() {
        return view('guest.privacypolicy.privacypolicy');
    }
}
