<?php

namespace App\Analyzer\Metrika;



use Carbon\Carbon;
use Mockery\Exception;

abstract class ReportLoader
{
    const URL = 'https://api-metrika.yandex.ru/stat/v1/data.csv?';

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $counter;

    public function __construct(string $counter, string $token)
    {
        $this->counter = $counter;
        $this->token   = $token;
    }

    /**
     * Параметры урла для загрузки отчета
     *
     * @return string[]
     */
    abstract protected function getUrlParams();

    /**
     * Урл для запроса отчета
     *
     * @return string
     */
    public function getUrl()
    {
        $url = self::URL . "oauth_token=" . $this->token . "&ids=" . $this->counter;

        $params = [];
        foreach ($this->getUrlParams() as $k => $v) {
            $params[] = $k . '=' . $v;
        }

        $url .= "&" . implode("&", $params);
        return $url;
    }

    /**
     * Получить текст отчета
     *
     * @param Carbon $from
     * @param Carbon $to
     * @return null|string
     */
    public function load(Carbon $from, Carbon $to)
    {
        $url = $this->getUrl() ."&date1=" . $from->format('Y-m-d') . "&date2=" . $to->format('Y-m-d');
        $rows = file($url);
        if (!$rows) {
           throw new Exception('Не удалось открыть отчет');
        }

        return implode('', array_slice($rows, 2));
    }
}
