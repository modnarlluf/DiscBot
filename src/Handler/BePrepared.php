<?php
namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class NomanskyTimeleft
 * @package ModnarLluf\DiscBot\Handler
 * @author Florian Rosito <florian@rosito.fr>
 */
class BePrepared implements MessageHandler
{
    const URL = 'http://memestorage.com/_nw/22/79844313.jpg';

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
        return $message->content === '!prepareyouranus' || $message->content === '!beprepared';
    }
}