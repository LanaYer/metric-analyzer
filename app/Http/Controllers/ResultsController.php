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

        $json = [
            'type' => 'line',
            'data' => [
                'labels' => [],
                'datasets' => [],
            ],
            'options' => [
                'responsive' => 'true',
                'annotation' => [
                    'annotations' =>[]
                ],
                'tooltips' => [
                    'mode' => 'index',
                    'intersect' => 'false',
                ],
                'scales' => [
                    'xAxes' => [
                        'display' => 'true',
                        'scaleLabel' => [
                            'display' => 'true',
                            'labelString' => 'Дата'
                        ],
                    ],
                    'yAxes' => [
                        'display' => 'true',
                        'scaleLabel' => [
                            'display' => 'true',
                            'labelString' => 'Количество посетителей'
                        ],
                    ],
                ],
            ],
        ];

        if (file_exists($graphs['visits']['data'])){

            $csv_array = array_map('str_getcsv', file($graphs['visits']['data']));


            for ($i=1; $i < count($csv_array); $i++){
                array_push($json['data']['labels'], $csv_array[$i][0]);
            }

            for ($i=1; $i < count($csv_array[0]); $i++){

                $data = [];

                for ($j=1; $j < count($csv_array); $j++){
                    array_push($data,$csv_array[$j][$i]);
                }

                array_push($json['data']['datasets'],
                    ['label' => $csv_array[0][$i],
                    'backgroundColor' => config('colors.color_'.$i),
                    'borderColor' => config('colors.color_'.$i),
                    'data' => $data,
                    'fill' => false]);
            }

            foreach ($experiment->steps as $step){

                array_push($json['options']['annotation']['annotations'],
                    ['type' => 'line',
                    'mode' => 'vertical',
                    'scaleID' => 'x-axis-0',
                    'value' => $step->start_at,
                    'borderColor' => 'gray']);

            }

            $config = json_encode($json);
        }

        else $config = "";

        return view('experiment.results',
            ['project' => $project, 'experiment' => $experiment, 'config' => $config]);
    }
}

