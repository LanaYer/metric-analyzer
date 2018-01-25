<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 22.01.18
 * Time: 19:39
 */

namespace app\Analyzer\Builder;


use App\Analyzer\Metrika\VisitReport;
use App\Models\Project;
use Carbon\Carbon;

class ProjectDataBuilder
{
    /**
     * @var Project
     */
    private $project;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Загрузка отчетов для проекта
     */
    public function loadData()
    {
        $result = [];
        $loader = new VisitReport($this->project->ym_login, $this->project->ym_token);
        foreach ($this->getWeeks() as $week)
        {
            $reportFile = $this->getReportFileName($week);

            if ($week->isLastWeek() || !is_file($reportFile)) {
                $file = $this->getReportFile($week);
                $content = $loader->load($week, (new Carbon($week))->addDay(6));
                if (!empty($content)) {
                    fwrite($file, $content);
                    fclose($file);
                }
            }

            $result[$reportFile] = filesize($reportFile);
        }

        return $result;
    }

    /**
     * @return Carbon[]
     */
    public function getWeeks()
    {
        $currentWeek = (new Carbon())->startOfWeek();
        if (!$this->project->start_at) {
            return [];
        }
        $startAt = (new Carbon($this->project->start_at))->startOfWeek();

        $periods = [];

        while ($startAt->timestamp < $currentWeek->timestamp) {
            $periods[] = new Carbon($startAt);
            $startAt->addWeek();
        }

       return $periods;
    }

    public function getReportFile(Carbon $date)
    {
        $file = fopen($this->getReportFileName($date), 'w');
        return $file;
    }

    public function getReportFileName(Carbon $date)
    {
        $dir = config('analyzer.path_to_data') ."/" . $this->project->id;
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return $dir ."/visits_" . $date->format('Y_m_d') . ".csv";
    }
}