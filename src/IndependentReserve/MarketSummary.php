<?php

namespace IndependentReserve;

use DateTime;

class MarketSummary
{
    /**
     * @return MarketSummary
     */
    public static function createFromObject()
    {
        return new self();
    }

    /**
     * @return DateTime
     */
    public function getCreatedTimestampUtc()
    {
        return new DateTime();
    }
}
