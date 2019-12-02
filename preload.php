<?php

$opts = include 'root.php';

/**
 * @param $path
 * @param array $except
 */
function __preload(
    string  $path,
    array   $except =  []
) {
    if(!in_array(
            $path,
            $except
        )
    ) {
        if(is_file($path)) {
            if(substr(
                    $path,
                    strlen($path) - 4,
                    4
                ) === '.php'
            ) {
                error_log('[COMPILE ' . $path . ']');

                require_once $path;
            }
        } else if(is_dir($path)) {
            $d = opendir($path);
            while(($dpath = readdir($d)) !== false) {
                if($dpath !== '..' &&
                    $dpath !== '.'
                ) {
                    __preload(
                        $path . DIRECTORY_SEPARATOR . $dpath,
                        $except
                    );
                }
            }
            closedir($d);
        } else {
            error_log('[UNKNOWN NODE ' . $path . ']');
        }
    }
}

foreach($opts['include'] as $include) {
    error_log('[INIT PRECOMPILER INCLUDE ' . $include . ']');

    require_once $include;
}

foreach($opts['directory'] as $root)  {
    error_log('[INIT PRECOMPILING FOR PATH ' . $root . ']');

    __preload(
        $root,
        [
            ...$opts['except'],
            ...$opts['include'],
            (__DIR__ . DIRECTORY_SEPARATOR . 'preload.php')
        ]
    );
}