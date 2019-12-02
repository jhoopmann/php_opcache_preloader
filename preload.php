<?php

$roots = include 'root.php';

/**
 * @param $path
 */
function __preload($path) {
    if(is_file($path)) {
        if(substr(
                $path,
                strlen($path) - 4,
                4
            ) === '.php'
        ) {
            if(!opcache_compile_file($path)) {
                error_log('[COMPILE ERR ' . $path. ']');
            } else {
                error_log('[COMPILED ' . $path . ']');
            }
        }
    } else if(is_dir($path)) {
        $d = opendir($path);
        while(($dpath = readdir($d)) !== false) {
            if($dpath !== '..' &&
                $dpath !== '.'
            ) {
                __preload($path . DIRECTORY_SEPARATOR . $dpath);
            }
        }
        closedir($d);
    } else {
        error_log('[UNKOWN FS NODE ' . $path . ']');
    }
}

foreach($roots as $root)  {
    $root = realpath($root);

    error_log('[INIT PRECOMPILING FOR PATH ' . $root . ']');

    __preload($root);
}