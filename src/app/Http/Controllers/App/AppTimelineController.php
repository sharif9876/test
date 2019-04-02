<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Task;
use App\TaskType;
use App\TaskEntry;

class AppTimelineController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('splash');
    }

    public function timeline() {

        return view('app.timeline.timeline', compact());
    }
}
