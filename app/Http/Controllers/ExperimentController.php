<?php

namespace App\Http\Controllers;

use App\Models\Segment;
use Illuminate\Http\Request;
use App\Models\Project;

class ExperimentController extends Controller
{

    public function index($id)
    {
        $experiments = Experiment::where('project_id', $id)->get();

        return view('experiment.index', ['experiments' => $experiments, 'project_id' => $id]);
    }
}
