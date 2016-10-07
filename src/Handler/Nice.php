<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class Nice
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class Nice implements MessageHandler
{
    const URL = 'http://i.imgur.com/e5ntYHu.jpg';

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
        return $message->content === '!nice';
    }

    /**
     * @return string
     */
    static public function getHelp()
    {
        return '!nice: dark humor certified.';
    }
}
