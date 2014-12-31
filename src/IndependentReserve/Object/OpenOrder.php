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

    /**
     * Primary currency of order.
     * @return string
     */
    public function getPrimaryCurrencyCode()
    {
        return $this->object->PrimaryCurrencyCode;
    }

    /**
     * Secondary currency of order.
     * @return string
     */
    public function getSecondaryCurrencyCode()
    {
        return $this->object->SecondaryCurrencyCode;
    }

    /**
     * Order status.
     * @see \IndependentReserve\OrderStatus::OPEN
     * @see \IndependentReserve\OrderStatus::PARTIALLY_FILLED
     * @return string
     */
    public function getStatus()
    {
        return $this->object->Status;
    }

    /**
     * The original volume ordered.
     * @return double
     */
    public function getVolume()
    {
        return $this->object->Volume;
    }
}
