<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

use App\Level;
use Validator;


class AdminLevelsController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }

    public function levels() {
        $levels = Level::all();
        (array) $levels;

        return view('admin/levels/levels', compact('levels'));
    }

    public function levelAdd() {
        $nextLevel = Level::max('level')+1;
        $points_min = Level::max('points');
        return view('admin/levels/leveladd', compact('nextLevel', 'points_min'));
    }

    public function levelEdit($id) {
        $level = Level::find($id);
        return view('admin/levels/levelEdit', compact('level'));
    }

    public function levelDelete($id) {
        $level = Level::find($id);
        $level->delete();
        return redirect('/admin/levels');
    }

    public function levelAddSave(Request $request) {
        $nextId = Level::max('id')+1;
        $validator = Validator::make($request->all(), [
            'level_level' => 'required|numeric',
            'level_points' => 'required|numeric',
            'level_image' => 'file|image'
        ]);
        if($validator->fails()) {
            return redirect(url('/admin/levels/add'));
        }
        if($request->has('level_image')) {
            $level_image = $request->file('level_image');
            $image_name = 'level_'.$nextId;
            $image_extention = $level_image->extension() == 'jpeg' ? '.jpg' : '.'.$level_extention;
            $image_path = public_path('/images/levels/');
            $level_image->move($image_path, $image_name.$image_extention);
        }
        Level::create([
            'level' => $request->input('level_level'),
            'points' => $request->input('level_points'),
            'container_background_image_path' => $request->has('level_image') ? $image_name.$image_extention : '',
            'container_background_color' => $request->input('level_color')
        ]);
        return redirect(url('/admin/levels'));
    }

    public function levelEditSave($id, Request $request) {
        $level = Level::find($id);
        $validator = Validator::make($request->all(), [
            'level_level' => 'required|numeric',
            'level_points' => 'required|numeric',
            'level_image' => 'file|image'
        ]);
        if($validator->fails()) {
            return redirect(url('/admin/levels/add'));
        }
        if($request->has('level_image')) {
            $level_image = $request->file('level_image');
            $image_name = $level->container_background_image_path;
            $image_extention = $level_image->extension() == 'jpeg' ? '.jpg' : '.'.$level_image->extension();
            $image_path = public_path('/images/levels/');
            if(File::exists($image_path.$image_name)) {
                File::delete($image_path.$image_name);
            }
            $level_image->move($image_path, 'level_'.$id.$image_extention);
        }
        $level->update([
            'level' => $request->has('level_level') ? $request->input('level_level') : $level->level,
            'points' => $request->has('level_points') ? $request->input('level_points') : $level->points,
            'container_background_image_path' => $request->has('level_image') ? 'level_'.$id.$image_extention : $level->container_background_image_path,
            'container_background_color' => $request->has('level_color') ? $request->input('level_color') : $level->container_background_color
        ]);

        return redirect(url('/admin/levels'));
    }
}
