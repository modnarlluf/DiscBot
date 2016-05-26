<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class Propre
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class Propre implements MessageHandler
{
    const URL = 'http://i.imgur.com/JAzMyA1.gif';

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
        return $message->content === '!propre';
    }

    /**
     * @return string
     */
    static public function getHelp()
    {
        return '!propre: sends a proper gif.';
    }
}