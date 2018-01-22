<?php

return [
    'graphs' => [

        'segments' => [
            'visits' => ['title' => 'Всего визитов'],
            'visits_ya' => ['title' => 'Yandex. Всего визитов'],
        ],
        'ab' => [
            'time' => ['title' => 'Время на сайте'],
	        'pages' => ['title' => 'Глубина просмотра'],
        ]
    ],
    'path_to_data' => storage_path() . '/graphs'
];
