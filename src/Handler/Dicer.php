<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

class Dicer implements MessageHandler
{
    public function handle($message)
    {
        list($n, $d, $p, $throws, $result) = $this->processMessage($message);

        $message->reply($this->getResponse($n, $d, $p, $throws, $result));

        return true;
    }

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

    static public function isHandlingMessage($message)
    {
        return preg_match('/^\!dice ((?P<n>\d+)d)?(?P<d>\d+)(\+(?P<p>\d+))?$/', $message->content);
    }
}