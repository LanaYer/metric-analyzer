<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Experiment;
use App\Models\Project;

class ExperimentController extends Controller
{

    public function index(Project $project)
    {
        return view('experiment.index', ['project' => $project]);
    }

    public function show($id, $experiment_id)
    {
        $experiment = Experiment::find($experiment_id);
        $segments = Segment::where('project_id', $id)->get();

        $experimentSegments = array();

        foreach ($experiment->segments as $expSegmItem){
            array_push($experimentSegments, $expSegmItem->id);
        }

        return view('experiment.update',
            ['experiment' => $experiment, 'segments' => $segments, 'project_id' => $id,
                'experimentSegments' => $experimentSegments]);
    }

    public function add_form($id)
    {
        $segments = Segment::where('project_id', $id)->get();

        return view('experiment.add', ['project_id' => $id, 'segments' => $segments]);
    }

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

        return redirect('/dashboard/project/'.$request->project_id.'/experiment');
    }

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

        return redirect('/dashboard/project/'.$experiment->project_id.'/experiment');
    }
}
