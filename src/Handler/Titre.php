<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class Titre
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class Titre implements MessageHandler
{
    const URL = 'http://i.imgur.com/IjAEuNS.gif';

    /**
     * @param $message
     * @return bool
     */
    public function handle($message)
    {
        $message->channel->sendMessage(self::URL);

        return true;
    }

    /**
     * @param $message
     * @return bool
     */
    static public function isHandlingMessage($message)
    {
        return $message->content === '!titre';
    }

    /**
     * @return string
     */
    static public function getHelp()
    {
        return '!titre: ( ͡° ͜ʖ ͡°)';
    }
}