<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Experiment;
use App\Models\Project;


class ResultsController extends Controller
{
    /**
     * @param Project $project
     * @param Experiment $experiment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Project $project, Experiment $experiment)
    {
        $graphs = $experiment->getGraphs();

        if (file_exists($graphs['visits']['data'])){

            $csv_array = array_map('str_getcsv', file($graphs['visits']['data']));
            $config = "{
                    type: 'line',
                    data: {
                        labels: [";

            for ($i=1; $i < count($csv_array); $i++){
                $config = $config."'".$csv_array[$i][0]."',";
            }

            $config = $config."],
                        datasets: [";

            for ($i=1; $i < count($csv_array[0]); $i++){
                $config = $config."{
                            label: '".$csv_array[0][$i]."',
                            backgroundColor: colors[".$i."],
                            borderColor: colors[".$i."],
                            data: [";

                for ($j=1; $j < count($csv_array); $j++){
                    $config = $config.$csv_array[$j][$i].",";
                }

                $config = $config."],
                            fill: false,
                        },";
            }

            $config = $config." ]
                    },
            options: {
                responsive: true,
                title:{
                    display:true,
                    text:'Эксперимент 1'
                },
                annotation: {
                    annotations: [";

            foreach ($experiment->steps as $step){
                $config = $config."{
                                type: 'line',
                                mode: 'vertical',
                                scaleID: 'x-axis-0',
                                value: '".$step->start_at."',
                                borderColor: 'gray',
                          },";
            }

            $config = $config."]
                },
                tooltips: {
                    mode: 'index',
                    intersect: false,
                },
                hover: {
                    mode: 'nearest',
                    intersect: true
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Дата'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Количество посетителей'
                        }
                    }]
                }
            }
                }";

        }
        else $config = "";

        return view('experiment.results',
            ['project' => $project, 'experiment' => $experiment, 'config' => $config]);
    }
}

