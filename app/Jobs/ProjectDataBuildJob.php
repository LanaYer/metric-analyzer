<?php

namespace App\Jobs;

use App\Analyzer\Builder\ProjectDataBuilder;
use App\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use DB;

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
            echo PHP_EOL.$project->name.PHP_EOL;

            $builder = new ProjectDataBuilder($project);
            $results = $builder->loadData();

            foreach ($results as $file => $length) {
                echo $file . '('.$length.')'.PHP_EOL;
            }
        }
    }
}
