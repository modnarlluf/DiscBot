<?php

namespace ModnarLluf\DiscBot;

use Discord\Discord;
use Discord\WebSockets\WebSocket;

/**
 * Class Server
 * @package ModnarLluf\DiscBot
 * @author Brice Sigura <brice@sigura.fr>
 */
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

    /**
     * @param $config
     * @param array $handlers
     */
    public function __construct($config, $handlers = [])
    {
        $this->config = $config;
        $this->discord = new Discord($config['bot']['token']);
        $this->ws = new WebSocket($this->discord);
        $this->dispatcher = new Dispatcher($handlers);

        $this->initWebsocket();
    }

    /**
     * Initialize websocket
     *
     * @return $this
     */
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

    /**
     * Run server, aka start running the websocket...
     *
     * @return $this
     */
    public function run()
    {
        $this->ws->run();

        return $this;
    }

}