<?php

namespace ModnarLluf\DiscBot\Handler;

use ModnarLluf\DiscBot\MessageHandler;

/**
 * Class NomanskyTimeleft
 * @package ModnarLluf\DiscBot\Handler
 * @author Brice Sigura <brice@sigura.fr>
 */
class NomanskyTimeleft implements MessageHandler
{
    const RELEASE_DATE = '2016-08-10 02:00:00';

    const MESSAGE_COUNTDOWN = '%m mois %d jours %H heures %i minutes et %s secondes';

    const MESSAGE_COUNTDOWN_OVER = 'Le jeu est lancé depuis '. self::MESSAGE_COUNTDOWN .' ! Go rejoindre le centre de l\'univers !';

    const MESSAGE_ENDING = 'avant de pouvoir se prendre pour un astronaute dans No Man\'s Sky !';

    const MESSAGE_ERROR = 'Erreur lors du décompte. :(';

    /**
     * @param $message
     * @return bool
     */
    public function handle($message)
    {
        $message->reply($this->getResponse());

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

    /**
     * @return string
     */
    static public function getHelp()
    {
        return '!nms.timeleft: shows the remaining time before No Man\'s Sky\'s launch.';
    }
}