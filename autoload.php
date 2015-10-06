<?php

    spl_autoload_register(function ($className) {
        $className = str_replace("\\", "/", $className);
        $fileName = __DIR__ . "/src/{$className}.php";
        if (file_exists($fileName)) {
            require( $fileName );
        }
    });
