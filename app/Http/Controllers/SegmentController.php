<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\SegmentPage;

class SegmentController extends Controller
{

    public function index($id)
    {
        $segments = Segment::where('project_id', $id)->orderBy('id', 'DESC')->get();

        return view('segment.index', ['segments' => $segments, 'project_id' => $id]);
    }

    public function show($id, $segment_id)
    {
        $segment = Segment::where('id', $segment_id)->get();

        $pages = Page::where('project_id', $id)->get();

        $pageSegm = SegmentPage::where('segment_id', $segment_id)->get();

        $pagesSegments = array();

        foreach ($pageSegm as $pageSegmItem){
            array_push($pagesSegments, $pageSegmItem->project_page_id);
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
                SegmentPage::create([
                    'segment_id' => $segment ->id,
                    'project_page_id' => $page
                ]);
            }
        }

        return redirect('/dashboard/project/'.$request->project_id.'/segment');
    }

    public function update(Request $request)
    {
        $segment = Segment::find($request->segment_id);

        $segment->name = $request->name;

        $segment->save();

        SegmentPage::where('segment_id', $segment->id)->delete();

        if ($request->pages){
            foreach ($request->pages as $page){
                SegmentPage::create([
                    'segment_id' => $segment ->id,
                    'project_page_id' => $page
                ]);
            }
        }

        return redirect('/dashboard/project/'.$segment->project_id.'/segment');
    }
}
