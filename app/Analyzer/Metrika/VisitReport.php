<?php

namespace App\Analyzer\Metrika;



use Carbon\Carbon;
use Mockery\Exception;

/**
 * Отчет по точкам входа
 *
 * Class VisitReport
 * @package App\Analyzer\Metrika
 */
class VisitReport extends ReportLoader
{
    /**
     * Параметры урла для загрузки отчета
     *
     * @return string[]
     */
    function getUrlParams()
    {
        return [
            'metrics' => "ym:s:visits,ym:s:users,ym:s:bounceRate,ym:s:pageDepth,ym:s:avgVisitDurationSeconds",
            'dimensions' => 'ym:s:startOfWeek,ym:s:date,ym:s:paramsLevel2,ym:s:LastSearchEngineRoot,ym:s:startURLHash',
            'filter' => "(ym:s:trafficSource=='organic')+and+ym:s:startOfWeek!n",
            'limit' => '100000'
        ];
    }
}
