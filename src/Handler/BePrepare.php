<?php
/**
 * Created by PhpStorm.
 * User: frosito
 * Date: 23/05/16
 * Time: 13:25
 */

namespace ModnarLluf\DiscBot\Handler;


use ModnarLluf\DiscBot\MessageHandler;

class BePrepare implements MessageHandler
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
        return $message->content === '!prepareyouranus' || $message->content === '!beprepare';
    }
}