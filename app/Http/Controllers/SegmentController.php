<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Segment;
use Illuminate\Http\Request;
use App\Models\Page;

class SegmentController extends Controller
{

    public function index(Project $project)
    {
        return view('segment.index', ['project' => $project]);
    }

    public function show(Project $project, Segment $segment)
    {
        $pagesSegments = array();

        foreach ($segment->pages() as $pageSegmItem){
            array_push($pagesSegments, $pageSegmItem->id);
        }

        return view('segment.update', ['segment' => $segment, 'project' => $project,
            'pagesSegments' => $pagesSegments ]);
    }

    public function add_form(Project $project)
    {
        return view('segment.add', ['project' => $project]);
    }

    public function add(Request $request)
    {
        $segment = Segment::create([
            'project_id' => $request->project_id,
            'name' => $request->name
        ]);

        if ($request->pages){
            foreach ($request->pages as $page){

                $segment->pages()->attach($page, ['segment_id' => $segment ->id]);
            }
        }

        return redirect('/dashboard/project/'.$request->project_id.'/segment');
    }

    public function update(Request $request)
    {
        $segment = Segment::find($request->segment_id);

        $segment->name = $request->name;

        $segment->save();

        $segment->pages()->detach();

        if ($request->pages){
            foreach ($request->pages as $page){

                $segment->pages()->attach($page, ['segment_id' => $segment ->id]);
            }
        }

        return redirect('/dashboard/project/'.$segment->project_id.'/segment');
    }
}
