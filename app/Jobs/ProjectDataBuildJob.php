<?php

namespace App\Jobs;

use App\Analyzer\Builder\ProjectDataBuilder;
use App\Models\Project;
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

            $totalFile = config('analyzer.path_to_data') . "/" . $project->id."/visits.csv";
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
                file_put_contents($totalFile, file_get_contents($file),FILE_APPEND);
            }
        }
    }
}
