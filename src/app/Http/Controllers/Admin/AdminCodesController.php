<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Code;
use Validator;
class AdminCodesController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }
     public function codes() {
        $codes = Code::all();
        (array) $codes;

        return view('admin/codes/codes', compact('codes'));
    }

    public function codeAdd(){

    	$errors = session('errors');
    	return view('admin/codes/codeAdd');
    }

     public function codeDelete($id) {
        $code = Code::find($id);
        $code->delete();
        return redirect('/admin/codes');
    }
    public function codeAddSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'code_code' => 'required|string',
            'code_points' => 'required|numeric',
            'code_levels' => 'required|numeric'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/levels/add'))->with('errors', $errors);
        }
       
        Code::create([
            'code' => $request->input('code_code'),
            'points' => $request->input('code_points'),
            'levels' => $request->input('code_levels'),
        ]);
        return redirect(url('/admin/codes'));
    }
    public function codeEdit($id) {
        $code = Code::find($id);
        $errors = session('errors');
        return view('admin/codes/codeEdit', compact('code', 'errors'));
    }
    public function codeEditSave($id, Request $request) {
        $code = Code::find($id);
        $validator = Validator::make($request->all(), [
            'code_code' => 'required|string',
            'code_points' => 'required|numeric',
            'code_levels' => 'required|numeric'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/codes/add'))->with('errors', $errors);
        }
       
        $code->update([
            'code' => $request->has('code_code') ? $request->input('code_code') : $code->code,
            'points' => $request->has('code_points') ? $request->input('code_points') : $code->points,
           'levels' => $request->has('code_levels') ? $request->input('code_levels') : $code->levels
        ]);

        return redirect(url('/admin/codes'));
    }



}
