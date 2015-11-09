<?php

namespace cform;



\Phar::mapPhar('cform');

spl_autoload_register(function ($class) {
    if (substr($class, 0, strlen(__NAMESPACE__)) != __NAMESPACE__)
        return;
    $path =  "phar://cform/src/" . str_replace("\\", "/", substr($class, strlen(__NAMESPACE__))) . ".php";
    require_once($path);
});


__HALT_COMPILER(); ?>