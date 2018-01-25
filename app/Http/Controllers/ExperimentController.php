<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Experiment;
use App\Models\ExperimentSegment;

class ExperimentController extends Controller
{

    public function index($id)
    {
        $experiments = Experiment::where('project_id', $id)->get();

        return view('experiment.index',
            ['experiments' => $experiments, 'project_id' => $id]);
    }

    public function show($id, $experiment_id)
    {
        $experiment = Experiment::where('id', $experiment_id)->get();
        $segments = Segment::where('project_id', $id)->get();

        return view('experiment.update',
            ['experiment' => $experiment, 'segments' => $segments, 'project_id' => $id]);
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
                ExperimentSegment::create([
                    'experiment_id' => $experiment->id,
                    'segment_id' => $segment,
                ]);
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

        ExperimentSegment::where('experiment_id', $experiment->id)->delete();

        if ($request->segments){
            foreach ($request->segments as $segment){
                ExperimentSegment::create([
                    'experiment_id' => $experiment->id,
                    'segment_id' => $segment,
                ]);
            }
        }

        return redirect('/dashboard/project/'.$experiment->project_id.'/experiment');
    }
}
