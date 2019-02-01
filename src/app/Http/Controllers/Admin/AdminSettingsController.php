<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminSettingsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function general() {
        return view('admin/settings/general');
    }
}
