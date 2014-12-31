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

    /**
     * Type of order.
     * @return string
     * @override
     */
    public function getType()
    {
        return $this->object->OrderType;
    }

    /**
     * Unfilled volume still outstanding on this order.
     * @return double
     */
    public function getOutstanding()
    {
        return $this->object->Outstanding;
    }
}
