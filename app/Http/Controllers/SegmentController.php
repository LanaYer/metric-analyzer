<?php

namespace App\Http\Controllers;

use App\Segment;
use Illuminate\Http\Request;
use App\Project;

class SegmentController extends Controller
{

    public function index($id)
    {
        $segments = Segment::where('project_id', $id)->get();

        return view('segment.index', ['segments' => $segments, 'project_id' => $id]);
    }
}
