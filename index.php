<?php

define('ROOT_PATH', __DIR__);

include_once ROOT_PATH.'/vendor/autoload.php';
$config = include_once ROOT_PATH.'/config.php';

use Discord\Discord;
use Discord\WebSockets\WebSocket;
use ModnarLluf\DiscBot\Handler as MessageHandler;

$discord = new Discord($config['token-bot']);

/** @var WebSocket $ws */
$ws = new WebSocket($discord);

$dispatcher = new \ModnarLluf\DiscBot\Dispatcher([
    new MessageHandler\Cat(),
    new MessageHandler\TaGueule(),
    new MessageHandler\Dicer(),
    new MessageHandler\OnlyWatch(),
    new MessageHandler\OverwatchTimeleft(),
    new MessageHandler\Propre(),
]);

$ws->on('ready', function ($discord) use ($ws, $dispatcher) {
    echo "Bot is ready!".PHP_EOL;

    $ws->on('message', function ($message, $discord) use ($ws, $dispatcher) {
        if ($message->author->username !== 'modnarbot') {
            // Send message to router
            $dispatcher->dispatch($message);
        }
    });
});

$ws->run();