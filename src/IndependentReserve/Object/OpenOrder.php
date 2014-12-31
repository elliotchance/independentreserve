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
}
