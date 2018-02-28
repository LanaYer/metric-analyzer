<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Segment;
use Illuminate\Http\Request;

class SegmentController extends Controller
{

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Project $project)
    {
        return view('segment.index', ['project' => $project]);
    }

    /**
     * @param Project $project
     * @param Segment $segment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project, Segment $segment)
    {
        $pagesSegments = $segment->pages->pluck('id')->all();

        return view('segment.update', ['segment' => $segment, 'project' => $project,
            'pagesSegments' => $pagesSegments ]);
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_form(Project $project)
    {
        return view('segment.add', ['project' => $project]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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
