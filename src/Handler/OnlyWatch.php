<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

class OnlyWatch implements MessageHandler
{
    const TAGUEULE_URL = 'http://i.imgur.com/3CKPQ4W.gif';

    public function handle($message)
    {
        $message->reply(self::TAGUEULE_URL);

        return true;
    }

    static public function isHandlingMessage($message)
    {
        return strpos($message->content, 'http://onlywat.ch') !== false;
    }
}