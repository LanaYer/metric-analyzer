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

    public function show($id, $experiment_id, $step_id)
    {
        $step = Step::find($step_id);

        return view('steps.update', ['step' => $step, 'project_id' => $id, 'experiment_id' => $experiment_id]);
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
        $step = Step::find($request->step_id);

        $step->description = $request->description;

        $step->start_at = $request->start_at;

        $step->save();

        return redirect('/dashboard/project/'.$request->project_id.'/experiment/'.$request->experiment_id.'/step');
    }
}
