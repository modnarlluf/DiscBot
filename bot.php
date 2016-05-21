<?php

define('APP_PATH', __DIR__ . '/app');

require_once __DIR__ . '/vendor/autoload.php';

if (!file_exists(APP_PATH . '/config.php')) {
    echo('Error, unable to fetch configuration file.'.PHP_EOL);
    exit(1);
}

$config = require_once APP_PATH . '/config.php';

$server = (new \ModnarLluf\DiscBot\Server($config))->run();