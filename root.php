<?php

return [
    'include' => [
        realpath(__DIR__ . '/../project/autoload.php')
    ],
    'except' => [
        '/home/jhoopmann/projects/project/events.php'
    ],
    'directory' => [
        realpath('project')
    ]
];
