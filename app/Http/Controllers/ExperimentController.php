<?php

namespace App\Http\Controllers;

use App\Segment;
use Illuminate\Http\Request;
use App\Project;

class ExperimentController extends Controller
{

    public function index($id)
    {
        $experiments = Experiment::where('project_id', $id)->get();

        return view('experiment.index', ['experiments' => $experiments, 'project_id' => $id]);
    }
}
