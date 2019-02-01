<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Question;

class AdminUsersController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function users() {
        $users = User::with('userInfo')->get();
        (array) $users;

        $user_info_types = Question::select('name', 'id')->get();
        (array) $user_info_types;

        return view('admin/users/users', compact('users', 'user_info_types'));
    }
}
