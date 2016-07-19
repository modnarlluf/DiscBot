<?php
require_once __DIR__.'/vendor/autoload.php';

if (!file_exists('./app/config.php')) {
    echo('Error, unable to fetch configuration file.'.PHP_EOL);
    exit(1);
}

$config = require_once './app/config.php';

use ModnarLluf\DiscBot\Handler as MessageHandler;

$server = (new \ModnarLluf\DiscBot\Server(
    $config,
    [
        new MessageHandler\Cat(),
        new MessageHandler\TaGueule(),
        new MessageHandler\Dicer(),
        new MessageHandler\OnlyWatch(),
        new MessageHandler\OverwatchTimeleft(),
        new MessageHandler\Propre(),
        new MessageHandler\NomanskyTimeleft(),
        new MessageHandler\Nice(),
    ]
))->run();
