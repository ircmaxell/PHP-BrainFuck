<?php

require_once __DIR__ . '/../lib/BrainFuck/Language.php';

spl_autoload_register(function($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require_once($file);
    }
});
