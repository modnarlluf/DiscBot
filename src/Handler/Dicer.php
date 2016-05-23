<?php

namespace ModnarLluf\DiscBot\Handler;

use Discord\Parts\Channel\Message;
use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class Dicer
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class Dicer implements MessageHandler
{
    /**
     * @param Message $message
     * @return bool
     */
    public function handle($message)
    {
        list($n, $d, $p, $throws, $result) = $this->processMessage($message);

        $message->reply($this->getResponse($n, $d, $p, $throws, $result));

        return true;
    }

    /**
     * @param Message $message
     * @return array
     */
    private function processMessage($message)
    {
        preg_match('/^\!dice ((?P<n>\d+)d)?(?P<d>\d+)(\+(?P<p>\d+))?$/', $message->content, $matches);

        $throws = [];
        $n = (int) ($matches['n'] ?: 1);
        $d = (int) ($matches['d'] ?: 20);
        $p = (int) (isset($matches['p']) ? $matches['p'] : 0);

        for ($i = 0; $i < $n; $i++) {
            $throws[] = mt_rand(1, $d);
        }

        $result = array_sum($throws) + $p;

        return [
            $n,
            $d,
            $p,
            $throws,
            $result,
        ];
    }

    /**
     * Get response text
     *
     * @param $n
     * @param $d
     * @param $p
     * @param $throws
     * @param $result
     * @return string
     */
    public function getResponse($n, $d, $p, $throws, $result)
    {
        return sprintf(
            "\n[%sd%s+%s]\n→ %s %s\n→ **%s**",
            $n,
            $d,
            $p,
            implode(' + ', $throws),
            $p > 0 ? "+ $p":"",
            $result
        );
    }

    /**
     * @param Message $message
     * @return int
     */
    static public function isHandlingMessage($message)
    {
        return preg_match('/^\!dice ((?P<n>\d+)d)?(?P<d>\d+)(\+(?P<p>\d+))?$/', $message->content);
    }
}