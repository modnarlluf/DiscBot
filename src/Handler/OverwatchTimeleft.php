<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

class OverwatchTimeleft implements MessageHandler
{
    const RELEASE_DATE = '2016-05-24 01:00:00';

    const MESSAGE_COUNTDOWN = '%d jours %H heures %i minutes et %s secondes';

    const MESSAGE_COUNTDOWN_OVER = 'Le jeu est lancé depuis '. self::MESSAGE_COUNTDOWN .' ! Go play !';

    const MESSAGE_ENDINGS = [
        'avant de péter des culs !',
        'et on pourra farmer du noob !',
        'avant de rager sur les loots !',
        'avant d\'insulter les joueurs de Bastion !',
        'avant de pouvoir mater le cul de Fatale !',
        'avant de pouvoir mater le cul de Tracer !',
    ];

    const MESSAGE_ERROR = 'Erreur lors du décompte. :(';

    /**
     * @param $message
     * @return bool
     */
    public function handle($message)
    {
        $message->channel->sendMessage($this->getResponse());

        return true;
    }

    /**
     * @return string
     */
    private function getResponse()
    {
        if ($countdown = $this->getCountdown()) {
            if ($countdown->invert) {

                return $countdown->format(self::MESSAGE_COUNTDOWN) .' '. $this->randMessageEnding();
            } else {

                return $countdown->format(self::MESSAGE_COUNTDOWN_OVER);
            }
        } else {

            return self::MESSAGE_ERROR;
        }
    }

    /**
     * @return bool|\DateInterval
     */
    private function getCountdown()
    {
        $releaseDate = \DateTime::createFromFormat('Y-m-d H:i:s', self::RELEASE_DATE);

        return $releaseDate->diff(new \DateTime());
    }

    /**
     * Return a random message from MESSAGE_ENDINGS
     *
     * @return mixed
     */
    private function randMessageEnding()
    {
        return self::MESSAGE_ENDINGS[mt_rand(0, count(self::MESSAGE_ENDINGS)-1)];
    }

    /**
     * @param $message
     * @return bool
     */
    static public function isHandlingMessage($message)
    {
        return $message->content === '!ow.timeleft';
    }
}