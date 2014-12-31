<?php

namespace IndependentReserve\Object;

use DateTime;

class ClosedOrder extends AbstractOrder
{
    /**
     * UTC timestamp of when order was created.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime($this->object->CreatedTimestampUtc);
    }

    /**
     * Unique identifier of the order.
     * @return string
     */
    public function getGuid()
    {
        return $this->object->OrderGuid;
    }
}
