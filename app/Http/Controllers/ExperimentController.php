<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Experiment;
use App\Models\Project;

class ExperimentController extends Controller
{

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Project $project)
    {
        return view('experiment.index', ['project' => $project]);
    }

    /**
     * @param Project $project
     * @param Experiment $experiment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Project $project, Experiment $experiment)
    {
        $experimentSegments = $experiment->segments->pluck('id')->all();
        $experimentPages = $experiment->pages->pluck('id')->all();

        return view('experiment.update',
            ['experiment' => $experiment, 'project' => $project,
                'experimentSegments' => $experimentSegments,
                'experimentPages' => $experimentPages]);
    }

    /**
     * @param Project $project
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add_form(Project $project)
    {
        return view('experiment.add', ['project' => $project, 'segments' => $project->segments]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function add(Request $request)
    {
        $isAbtest = 0;

        if ($request->is_abtest){
            $isAbtest = 1;
        }

        $experiment = Experiment::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'description' => $request->description,
            'is_abtest' => $isAbtest,
            'is_active' => 1
        ]);

        if ($request->segments){
            foreach ($request->segments as $segment){

                $experiment->segments()->attach($segment, ['experiment_id' => $experiment->id]);
            }
        }

        if ($request->pages){
            foreach ($request->pages as $page){

                $experiment->pages()->attach($page, ['experiment_id' => $experiment->id]);
            }
        }

        return redirect('/dashboard/project/'.$request->project_id.'/experiment');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request)
    {
        $experiment = Experiment::find($request->id);
        $isActive = 0;
        $isAbtest = 0;

        if ($request->is_active){
            $isActive = 1;
        }
        if ($request->is_abtest){
            $isAbtest = 1;
        }

        $experiment->name = $request->name;
        $experiment->description = $request->description;
        $experiment->is_abtest = $isAbtest;
        $experiment->is_active = $isActive;

        $experiment->save();

        $experiment->segments()->detach();

        if ($request->segments){
            foreach ($request->segments as $segment){

                $experiment->segments()->attach($segment, ['experiment_id' => $experiment->id]);
            }
        }

        $experiment->pages()->detach();

        if ($request->pages){
            foreach ($request->pages as $page){

                $experiment->pages()->attach($page, ['experiment_id' => $experiment->id]);
            }
        }

        return redirect('/dashboard/project/'.$experiment->project_id.'/experiment');
    }
}
