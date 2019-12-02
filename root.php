<?php

return [
    'include' => [
        realpath(__DIR__ . '/../warehouse.sportimport.de/php/autoload.php')
    ],
    'except' => [
        '/home/jhoopmann/projects/warehouse.sportimport.de/php/SportImport/Warehouse/Runnable/events.php'
    ],
    'directory' => [
        realpath(
            __DIR__ . DIRECTORY_SEPARATOR . '..' .
                DIRECTORY_SEPARATOR . 'warehouse.sportimport.de' . 
                DIRECTORY_SEPARATOR . 'php/SportImport'
        )
    ]
];
