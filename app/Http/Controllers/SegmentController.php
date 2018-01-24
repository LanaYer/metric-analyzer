<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;
use App\Models\Project;

class SegmentController extends Controller
{

    public function index($id)
    {
        $segments = Segment::where('project_id', $id)->get();

        return view('segment.index', ['segments' => $segments, 'project_id' => $id]);
    }

    public function show($id, $segment_id)
    {
        $segment = Segment::where('id', $segment_id)->get();

        return view('segment.update', ['segment' => $segment, 'project_id' => $id]);
    }

    public function add_form($id)
    {
        return view('segment.add', ['project_id' => $id]);
    }

    public function add(Request $request)
    {
        Segment::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'pages' => $request->page
        ]);
        return redirect('/dashboard/project/'.$request->project_id.'/segment');
    }
}
