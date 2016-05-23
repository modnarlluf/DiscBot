<?php

namespace ModnarLluf\DiscBot;
use Discord\Parts\Channel\Message;

/**
 * Class Dispatcher
 * @package ModnarLluf\DiscBot
 * @author Brice Sigura <brice@sigura.fr>
 */
class Dispatcher
{
    /**
     * @var array
     */
    private $messageHandlers = [];

    /**
     * @param array $handlers
     */
    public function __construct($handlers = [])
    {
        $this->messageHandlers = $handlers;
    }

    /**
     *
     * @param $message
     */
    public function dispatch($message)
    {
        if (0 === strpos($message->content, '!help')) {
            $this->help($message);
        } else {
            $this->dispatchToHandlers($message);
        }
    }

    /**
     * Loop on handlers and handle message for compatibles handlers
     *
     * @param Message $message
     */
    public function dispatchToHandlers($message)
    {
        foreach($this->listHandlers() as $handler) {
            /** @var MessageHandler $handler */
            if ($handler::isHandlingMessage($message)) {
                $handler->handle($message);
            }
        }
    }

    /**
     * Loop on handlers to print each help
     *
     * @param $message
     */
    public function help($message)
    {
        $helps = [];

        foreach($this->listHandlers() as $handler) {
            /** @var MessageHandler $handler */
            $helps[] = $handler::getHelp();
        }

        $help = '```'. implode("\n\n", $helps) .'```';

        $message->channel->sendMessage($help);
    }

    /**
     * @return \Generator
     */
    private function listHandlers()
    {
        foreach($this->messageHandlers as $messageHandler) {
            yield $messageHandler;
        }
    }

    /**
     * @param MessageHandler $messageHandler
     * @return $this
     */
    public function addHandler(MessageHandler $messageHandler)
    {
        $this->messageHandlers[] = $messageHandler;
        return $this;
    }

    /**
     * @param MessageHandler[] $messageHandlers
     * @return $this
     */
    public function addHandlers($messageHandlers)
    {
        $this->messageHandlers = array_merge($this->messageHandlers, $messageHandlers);
        return $this;
    }
}