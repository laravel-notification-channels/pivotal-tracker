<?php

namespace NotificationChannels\pivotal-tracker\Exceptions;

use Exception;

class CouldNotSendNotification extends Exception
{
    public static function serviceRespondedWithAnError($response)
    {
        return new static('Pivotal Tracker responded with an error: `' . $response->getBody()->getContents() . '`');
    }
}
