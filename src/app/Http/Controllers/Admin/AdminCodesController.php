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
            'code_code' => 'required|string|unique:codes,code',
            'code_active' => 'required',
            'code_levels' => 'required|numeric|min:1'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/codes/add'))->with('errors', $errors);
        }
       
        Code::create([
            'code' => $request->input('code_code'),
            'levels' => $request->input('code_levels'),
            'active' => $request->input('code_active')=="True"?1:0,
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
            'code_active' => 'required|',
            'code_levels' => 'required|numeric|min:1'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/codes/'.$id.'/edit'))->with('errors', $errors);
        }
       
        $code->update([
            'code' => $request->has('code_code') ? $request->input('code_code') : $code->code,
            'levels' => $request->has('code_levels') ? $request->input('code_levels') : $code->points,
           'active' => $request->has('code_active') ? $request->input('code_active')=="True" ?1:0 : $code->levels
        ]);

        return redirect(url('/admin/codes'));
    }



}
