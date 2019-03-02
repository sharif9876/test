<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

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
        $nextLevel = Level::max('id')+1;
        $points_min = Level::max('points');
        return view('admin/levels/leveladd', compact('nextLevel', 'points_min'));
    }

    public function levelDelete($id) {
        $task = Level::find($id);
        $task->delete();
        return redirect('/admin/levels');
    }
}
