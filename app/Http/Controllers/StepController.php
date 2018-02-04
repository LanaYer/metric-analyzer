<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Step;
use App\Models\Segment;

class StepController extends Controller
{

    public function index($experiment_id, $id)
    {
        $steps = Step::where('experiment_id', $experiment_id)->orderBy('id', 'DESC')->get();

        return view('steps.index', ['steps' => $steps, 'project_id' => $id, 'experiment_id' => $experiment_id]);
    }

    public function show($id, $segment_id)
    {
        $segment = Segment::find($segment_id);
        $pages = Page::where('project_id', $id)->get();

        $pagesSegments = array();

        foreach ($segment->pages as $pageSegmItem){
            array_push($pagesSegments, $pageSegmItem->id);
        }

        return view('steps.update', ['segment' => $segment, 'project_id' => $id, 'pages' => $pages,
            'pagesSegments' => $pagesSegments ]);
    }

    public function add_form($id, $experiment_id)
    {
        return view('steps.add', ['project_id' => $id, 'experiment_id' => $experiment_id]);
    }

    public function add(Request $request)
    {
        $segment = Step::create([
            'experiment_id' => $request->experiment_id,
            'description' => $request->description,
            'start_at' => $request->start_at
        ]);

        return redirect('/dashboard/project/'.$request->project_id.'/experiment/'.$request->experiment_id.'/step');
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
