<?php
require_once __DIR__.'/vendor/autoload.php';

if (!file_exists('./app/config.php')) {
    echo('Error, unable to fetch configuration file.'.PHP_EOL);
    exit(1);
}

$config = require_once './app/config.php';

$server = (new \ModnarLluf\DiscBot\Server($config))->run();