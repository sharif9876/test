<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\User;
use App\Option;

class AdminSettingsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function general() {
        return view('admin.settings.general');
    }

    public function pages() {
        $settings = [
            'pages_about_text' => Option::get('page_about_text'),
            'pages_tos_text' => Option::get('page_tos_text'),
            'pages_pp_text' => Option::get('page_pp_text')
        ];
        return view('admin.settings.pages', compact('settings'));

    }

    public function pagesEditSave(Request $request) {
        $validator = Validator::make($request->all(), [
            'pages_about_text' => 'max:1000',
            'pages_tos_text' => 'max:1000',
            'pages_pp_text' => 'max: 1000'
        ]);
        if($validator->fails()) {
            $errors = $validator->errors();
            return redirect(url('/admin/settings/pages'))->with('errors', $errors);
        }

        Option::set('page_about_text', $request->input('pages_about_text') != '' ? $request->input('pages_about_text') : '');
        Option::set('page_tos_text', $request->input('pages_tos_text') != '' ? $request->input('pages_tos_text') : '');
        Option::set('page_pp_text', $request->input('pages_pp_text') != '' ? $request->input('pages_pp_text') : '');

        return redirect(url('/admin/settings/pages'));
    }
}
