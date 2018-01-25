<?php

namespace App\Jobs;

use App\Analyzer\Builder\ProjectDataBuilder;
use App\Models\Experiment;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class ProjectDataBuildJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    private $projectId;

    public function __construct($projectId = null)
    {
        $this->projectId = $projectId;
    }

    /**
     * Обработка джобы.
     *
     */
    public function handle()
    {
        $projects = $this->projectId ?
            Project::where('id', $this->projectId)->active()->get() :
            Project::active()->get();

        foreach ($projects as $project) {
            echo PHP_EOL."####ПРОЕКТ " . $project->name ."####".PHP_EOL;

            if ($this->loadDataFromMetrika($project)) {
                $this->createGraph($project);
            }
        }
    }

    /**
     * @param Project $project
     * @return bool
     */
    protected function loadDataFromMetrika(Project $project)
    {
        echo PHP_EOL . "-----загружаем данные из метрики-----".PHP_EOL;

        $builder = new ProjectDataBuilder($project);
        $results = $builder->loadData();

        $totalFile = $project->getDataDir() ."/visits.csv";
        if (is_file($totalFile)) {
            unlink($totalFile);
        }

        if (count($results)) {
            file_put_contents(
                $totalFile,
                '"week","visit date","search system","enter page","visit num","visitors","bounce","depth","page time","total"'.PHP_EOL
            );
        }

        foreach ($results as $file => $length) {
            echo "   >>Загружен файл " . $file ."(".$length.")" . PHP_EOL;
            file_put_contents($totalFile, file_get_contents($file),FILE_APPEND);
        }

        if (is_file($totalFile)) {
            echo "Данные по визитам собраны в файл " . $totalFile .'('.filesize($totalFile).')' . PHP_EOL;
        } else {
            echo "Нет данных по визитам для проекта " . $project->name.PHP_EOL;
        }


        return true;
    }

    /**
     * @param Project $project
     */
    protected function createGraph(Project $project)
    {
        /**
         * @var Experiment[] $experiments
         */
        $experiments = Experiment::where('project_id', '=', $project->id)
            ->active()
            ->get();


        echo PHP_EOL . "---- обрабатываем эксперименты-----" . PHP_EOL;

        foreach ($experiments as $experiment) {

            echo "     >>" . $experiment->name.PHP_EOL;

            //публикуем описание эксперимента в json
            if ($experiment->saveJsonDescription()) {
                $graphs = $experiment->getGraphs();

                echo "      >>>>  публикуем графики" .PHP_EOL;
                foreach ($graphs as $name => $params) {
                    $cmd = 'cd ' . resource_path() . "/python && python graph.py -d ".$project->getDataDir()." -c visits -m ".$name." -e " . $experiment->id;
                    echo "              " . $cmd.PHP_EOL;
                    $process = new Process($cmd);
                    $process->run();

                    // executes after the command finishes
                    if (!$process->isSuccessful()) {
                        throw new ProcessFailedException($process);
                    }
                }
            }
        }
    }
}
