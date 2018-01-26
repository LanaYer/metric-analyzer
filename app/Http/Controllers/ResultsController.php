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
        $experiment = Experiment::where('id', $experiment_id)->first()->getGraphs();

        $csvUrl = $experiment['visits']['data'];

        $csv= file_get_contents($csvUrl);
        $array = array_map("str_getcsv", explode("\n", $csv));
        $json = json_encode($array);
        //dd($json);

        $json = "{
                    type: 'line',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                        datasets: [
                            {
                            label: 'My First dataset',
                            backgroundColor: colors[0],
                            borderColor: colors[0],
                            data: [2, 4, 3, 4, 6, 3, 2],
                            fill: false,
                        },
                        ]

                    },
                    options: {
                        responsive: true
                    }
                }";

        return view('experiment.results',
            ['project_id' => $id, 'experiment_id' => $experiment_id, 'json' => $json]);
    }

}
