<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;
use App\Models\Page;

class SegmentController extends Controller
{

    public function index($id)
    {
        $segments = Segment::where('project_id', $id)->orderBy('id', 'DESC')->get();

        return view('segment.index', ['segments' => $segments, 'project_id' => $id]);
    }

    public function show($id, $segment_id)
    {
        $segment = Segment::find($segment_id);
        $pages = Page::where('project_id', $id)->get();

        $pagesSegments = array();

        foreach ($segment->pages as $pageSegmItem){
            array_push($pagesSegments, $pageSegmItem->id);
        }

        return view('segment.update', ['segment' => $segment, 'project_id' => $id, 'pages' => $pages,
            'pagesSegments' => $pagesSegments ]);
    }

    public function add_form($id)
    {
        $pages = Page::where('project_id', $id)->get();

        return view('segment.add', ['project_id' => $id, 'pages' => $pages]);
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
