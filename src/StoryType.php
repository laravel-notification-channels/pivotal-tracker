<?php

namespace NotificationChannels\PivotalTracker;

final class StoryType
{
    const FEATURE = 'feature';
    const BUG = 'bug';
    const CHORE = 'chore';

    /**
     * @param string $type
     *
     * @return bool
     */
    public static function isValid($type)
    {
        return in_array($type, [self::FEATURE, self::BUG, self::CHORE]);
    }
}
