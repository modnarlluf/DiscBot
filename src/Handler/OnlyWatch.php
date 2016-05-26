<?php

namespace ModnarLluf\DiscBot\Handler;

use Discord\Parts\Channel\Message;
use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class OnlyWatch
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class OnlyWatch implements MessageHandler
{
    const TAGUEULE_URL = 'http://i.imgur.com/3CKPQ4W.gif';

    /**
     * @param Message $message
     * @return bool
     */
    public function handle($message)
    {
        $message->reply(self::TAGUEULE_URL);

        return true;
    }

    /**
     * @param Message $message
     * @return bool
     */
    static public function isHandlingMessage($message)
    {
        return strpos($message->content, 'http://onlywat.ch') !== false;
    }

    /**
     * @return string
     */
    static public function getHelp()
    {
        return 'If a message contains http://onlywat.ch, this bot reply with an outrageous gif.';
    }
}