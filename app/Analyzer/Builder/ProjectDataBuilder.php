<?php
/**
 * Created by PhpStorm.
 * User: nikolay
 * Date: 22.01.18
 * Time: 19:39
 */

namespace app\Analyzer\Builder;


use App\Analyzer\Metrika\VisitReport;
use App\Project;
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
        foreach ($this->getMonths() as $month)
        {
            $file = $this->getReportFile($month);
            $content = $loader->load($month->firstOfMonth(), $month->lastOfMonth());
            fwrite($file, $content);
            fclose($file);
            $result[$this->getReportFileName($month)] = mb_strlen($content);
        }

        return $result;
    }

    /**
     * @return Carbon[]
     */
    public function getMonths()
    {
        $yesterday = Carbon::yesterday();
        $lastLoad = new Carbon($this->project->last_load_at);
        $lastLoad->addDay();

        $periods = [];

        while ($lastLoad < $yesterday) {
            $periods[] = $lastLoad;
            $lastLoad = $lastLoad->addMonth();
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
        return config('analyzer.path_to_data') ."/" . $this->project ."/visits_" . $date->format('Y_m') . ".csv";
    }
}