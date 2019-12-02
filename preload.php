<?php

$opts = include 'root.php';

/**
 * @param $path
 */
function __preload(
    $path,
    $except =  []
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
            error_log('[UNKOWN FS NODE ' . $path . ']');
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