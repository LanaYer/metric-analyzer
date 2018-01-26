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
        $csv_array = array_map('str_getcsv', file($csvUrl));

        $config = "{
                    type: 'line',
                    data: {
                        labels: [";

        for ($i=1; $i < count($csv_array); $i++){
            $config = $config.$csv_array[$i][0].",";
        }

        $config = $config."],
                        datasets: [";

        for ($i=1; $i < 4; $i++){
            $config = $config."                            {
                            label: 'My First dataset',
                            backgroundColor: colors[5],
                            borderColor: colors[5],
                            data: [";

           for ($j=1; $j < count($csv_array); $j++){
                $config = $config.$csv_array[$j][$i].",";
            }

            $config = $config."],
                            fill: false,
                        },";
        }

        $config = $config."                        ]

                    },
                    options: {
                        responsive: true
                    }
                }";

        return view('experiment.results',
            ['project_id' => $id, 'experiment_id' => $experiment_id, 'config' => $config]);
    }
}

