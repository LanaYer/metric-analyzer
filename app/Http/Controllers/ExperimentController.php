<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Experiment;

class ExperimentController extends Controller
{

    public function index($id)
    {
        $experiments = Experiment::where('project_id', $id)->get();

        return view('experiment.index', ['experiments' => $experiments, 'project_id' => $id]);
    }

    public function show($id, $experiment_id)
    {
        $experiment = Experiment::where('id', $experiment_id)->get();

        return view('experiment.update', ['segment' => $experiment, 'project_id' => $id]);
    }

    public function add_form($id)
    {
        return view('experiment.add', ['project_id' => $id]);
    }

    public function add(Request $request)
    {
        if ($request->is_abtest){
            $isAbtest = 1;
        }

        Experiment::create([
            'project_id' => $request->project_id,
            'name' => $request->name,
            'description' => $request->description,
            'is_abtest' => $isAbtest,
            'is_active' => 1
        ]);
        return redirect('/dashboard/project/'.$request->project_id.'/experiment');
    }

    public function update(Request $request)
    {
        $segment = Segment::find($request->segment_id);

        $segment->name = $request->name;
        $segment->pages = $request->page;

        $segment->save();

        return redirect('/dashboard/project/'.$segment->project_id.'/segment');
    }
}
