<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Step;
use App\Models\Segment;

class StepController extends Controller
{

    public function index(Project $project, Experiment $experiment)
    {
        return view('steps.index', ['steps' => $experiment->steps(), 'project' => $project, 'experiment' => $experiment]);
    }

    public function show(Project $project, Experiment $experiment, Step $step)
    {
        return view('steps.update', ['step' => $step, 'project' => $project, 'experiment' => $experiment]);
    }

    public function add_form(Project $project, Experiment $experiment)
    {
        return view('steps.add', ['project' => $project, 'experiment' => $experiment]);
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
        $step = Step::find($request->step_id);

        $step->experiment_id = $request->experiment_id;

        $step->description = $request->description;

        $step->start_at = $request->start_at;

        $step->save();

        return redirect('/dashboard/project/'.$request->project_id.'/experiment/'.$request->experiment_id.'/step');
    }
}
