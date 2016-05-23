<?php

namespace ModnarLluf\DiscBot\Handler;

use GuzzleHttp\Client;
use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class Cat
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class Cat implements MessageHandler
{
    const THECATAPI_URL = 'http://thecatapi.com/api/images/get?type=jpg';

    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $message
     * @return bool
     */
    public function handle($message)
    {
        $this->client->get(self::THECATAPI_URL, [
            'on_stats' => function (\GuzzleHttp\TransferStats $stats) use (&$url) {
                $url = $stats->getEffectiveUri()->__toString();
            }
        ]);
        $message->channel->sendMessage($url);

        return true;
    }

    /**
     * @param $message
     * @return bool
     */
    static public function isHandlingMessage($message)
    {
        return $message->content === '!cat';
    }
}