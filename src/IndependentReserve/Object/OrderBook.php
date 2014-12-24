<?php

namespace IndependentReserve\Object;

use DateTime;

class OrderBook extends AbstractObject
{
    /**
     * UTC timestamp of when the order book was generated.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime($this->object->CreatedTimestampUtc);
    }
}
