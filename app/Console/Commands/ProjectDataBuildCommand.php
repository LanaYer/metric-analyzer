<?php

namespace App\Console\Commands;

use App\Jobs\ProjectDataBuildJob;
use Illuminate\Console\Command;

class ProjectDataBuildCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:build {--projectId=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Сбор данных для проектов';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $projectId  = $this->option('projectId');

        $job = app(ProjectDataBuildJob::class, [
            'projectId'  => $projectId,
        ]);

        dispatch($job);
    }
}
