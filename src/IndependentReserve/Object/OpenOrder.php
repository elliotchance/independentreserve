<?php

namespace IndependentReserve\Object;

use DateTime;

class OpenOrder extends AbstractOrder
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
     * @return double
     */
    public function getEstimatedValue()
    {
        return $this->object->EstimatedValue;
    }

    /**
     * Unique identifier of the order.
     * @return string
     */
    public function getOrderGuid()
    {
        return $this->object->OrderGuid;
    }
}
