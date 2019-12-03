# php_opcache_preloader
simple preloader 4 php 74 opcache

no possibility to configurate virtualhost separated, php.ini or conf.d setup.

opcache.preload=/path/preload.php
opcache.preload_user=username
opcache.errorlog=/path/error.log

add directories to precompile to key "directory" in root.php, excluded in except and autoloaders with registering functionality to "include"
