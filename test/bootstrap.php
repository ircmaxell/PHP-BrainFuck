<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Composer\Autoload\ClassLoader;

$ClassLoader = new ClassLoader;
$ClassLoader -> add('BrainFuck', __DIR__.'/../lib/');
$ClassLoader -> register();