<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

class NomanskyTimeleft implements MessageHandler
{
    const RELEASE_DATE = '2016-06-22 02:00:00';

    const MESSAGE_COUNTDOWN = '%d jours %H heures %i minutes et %s secondes';

    const MESSAGE_COUNTDOWN_OVER = 'Le jeu est lancé depuis '. self::MESSAGE_COUNTDOWN .' ! Go play !';

    const MESSAGE_ENDING = 'avant de pouvoir jouer à No Man\'s Sky !';

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

                return $countdown->format(self::MESSAGE_COUNTDOWN) .' '. self::MESSAGE_ENDING;
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
     * @param $message
     * @return bool
     */
    static public function isHandlingMessage($message)
    {
        return $message->content === '!nms.timeleft';
    }
}