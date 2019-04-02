<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\User;
use App\Question;
use App\Level;

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

    public function userAdd() {
        $level_max = Level::max('id');
        $errors = session('errors');
        return view('admin/users/userAdd', compact('level_max', 'errors'));
    }

    public function userEdit($id) {
        $user = User::find($id);
        $level_max = Level::max('id');
        $errors = session('errors');
        return view('admin/users/userEdit', compact('user', 'level_max', 'errors'));
    }

    public function userDelete($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/admin/users');
    }

    public function userAddSave(Request $request) {
        $level_max = Level::max('id');
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:191',
            'user_email' => 'required|email|unique:users,email|max:191',
            'user_level' => 'required|min:0|max:'.$level_max,
            'user_password' => 'required',
            'user_userlevel' => 'required|in:member,admin,owner'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/users/add'))->with('errors', $errors);
        }
        User::create([
            'name' => $request->input('user_name'),
            'email' => $request->input('user_email'),
            'level' => $request->input('user_level'),
            'points' => 0,
            'password' => Hash::make($request->input('user_password')),
            'userlevel' => $request->input('user_userlevel')
        ]);
        return redirect(url('/admin/users'));
    }

    public function userEditSave($id, Request $request) {
        $level_max = Level::max('id');
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|max:191',
            'user_email' => 'required|email|max:191',
            'user_level' => 'required|min:0|max:'.$level_max,
            'user_password' => '',
            'user_userlevel' => 'required|in:member,admin,owner'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/users/'.$id.'/edit'))->with('errors', $errors);
        }
        $user = User::find($id);
        $user->update([
            'name' => $request->has('user_name') ? $request->input('user_name') : $user->name,
            'email' => $request->has('user_email') ? $request->input('user_email') : $user->email,
            'level' => $request->has('user_level') ? $request->input('user_level') : $user->level,
            'points' => 0,
            'password' => $request->has('user_password') ? Hash::make($request->input('user_password')) : $user->name,
            'userlevel' => $request->has('user_userlevel') ? $request->input('user_userlevel') : $user->userlevel
        ]);
        return redirect(url('/admin/users'));
    }
}
