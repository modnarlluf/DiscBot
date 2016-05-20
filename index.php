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

$router = new \ModnarLluf\DiscBot\Router([
    new MessageHandler\Cat(),
    new MessageHandler\TaGueule(),
    new MessageHandler\Dicer(),
    new MessageHandler\OnlyWatch(),
    new MessageHandler\OverwatchTimeleft(),
]);

$ws->on('ready', function ($discord) use ($ws, $router) {
    echo "Bot is ready!".PHP_EOL;

    $ws->on('message', function ($message, $discord) use ($ws, $router) {
        if ($message->author->username !== 'modnarbot') {
            // Send message to router
            $router->sendThroughHandlers($message);
        }
    });
});

$ws->run();