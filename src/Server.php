<?php

namespace ModnarLluf\DiscBot;

use Discord\Discord;
use Discord\WebSockets\WebSocket;
use ModnarLluf\DiscBot\Handler as MessageHandler;

class Server
{
    /** @var Discord */
    private $discord;

    /** @var WebSocket */
    private $ws;

    /** @var Dispatcher */
    private $dispatcher;

    /** @var array */
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
        $this->discord = new Discord($config['bot']['token']);
        $this->ws = new WebSocket($this->discord);
        $this->dispatcher = new Dispatcher();

        $this->init();
    }

    public function init()
    {
        return $this
            ->initDispatcher()
            ->initWebsocket();
    }

    private function initDispatcher()
    {
        $this->dispatcher->addHandlers([
            new MessageHandler\Cat(),
            new MessageHandler\TaGueule(),
            new MessageHandler\Dicer(),
            new MessageHandler\OnlyWatch(),
            new MessageHandler\OverwatchTimeleft(),
            new MessageHandler\Propre(),
            new MessageHandler\NomanskyTimeleft(),
            new MessageHandler\BePrepare(),
        ]);

        return $this;
    }

    private function initWebsocket()
    {
        $this->ws->on('ready', function ($discord) {
            echo "Bot is ready!".PHP_EOL;

            $this->ws->on('message', function ($message, $discord) {
                if ($message->author->username !== $this->config['bot']['username']) {
                    $this->dispatcher->dispatch($message);
                }
            });
        });

        return $this;
    }

    public function run()
    {
        $this->ws->run();

        return $this;
    }

}