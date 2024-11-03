<?php

spl_autoload_register(static function (string $className) {
    $dirs = [
        'model',
        'controller',
        'view',
        'service',
    ];

    foreach ($dirs as $dir) {
        $path = "$dir/$className.php";
        if (file_exists($path)) {
            require_once $path;
            break;
        }
    }
});
