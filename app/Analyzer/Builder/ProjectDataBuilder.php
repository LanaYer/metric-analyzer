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
            $file = $this->getReportFile($week);
            $content = $loader->load($week, (new Carbon($week))->addDay(6));
            if (!empty($content)) {
                fwrite($file, $content);
                fclose($file);
                $result[$this->getReportFileName($week)] = mb_strlen($content);
                if (!$week->isLastWeek()) {
                    $this->project->last_load_at = $week->format('Y-m-d');
                    $this->project->save();
                }

            }

        }

        return $result;
    }

    /**
     * @return Carbon[]
     */
    public function getWeeks()
    {
        $currentWeek = (new Carbon())->startOfWeek();
        $startAt = $this->project->last_load_at ? $this->project->last_load_at : $this->project->start_at;
        if (!$startAt) {
            return [];
        }
        $lastLoad = (new Carbon($startAt))->startOfWeek();

        $periods = [];

        while ($lastLoad->timestamp < $currentWeek->timestamp) {
            $periods[] = new Carbon($lastLoad);
            $lastLoad->addWeek();
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
        var_dump($dir);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        return $dir ."/visits_" . $date->format('Y_m_d') . ".csv";
    }
}