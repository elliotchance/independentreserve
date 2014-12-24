<?php

namespace IndependentReserve\Object;

use DateTime;

class TradeHistorySummary extends AbstractObject
{
    /**
     * UTC timestamp of when the data was generated.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime($this->object->CreatedTimestampUtc);
    }
}
