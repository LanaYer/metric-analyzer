<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Segment;
use App\Models\Experiment;
use App\Models\ExperimentSegment;

class ResultsController extends Controller
{

    public function index($id, $experiment_id)
    {
        return view('experiment.results', ['project_id' => $id, 'experiment_id' => $experiment_id]);
    }

}
