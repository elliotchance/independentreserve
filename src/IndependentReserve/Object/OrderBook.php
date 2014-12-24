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

    /**
     * The primary currency being shown.
     * @return string
     */
    public function getPrimaryCurrencyCode()
    {
        return $this->object->PrimaryCurrencyCode;
    }

    /**
     * The secondary currency being used for pricing.
     * @return string
     */
    public function getSecondaryCurrencyCode()
    {
        return $this->object->SecondaryCurrencyCode;
    }

    /**
     * @return array
     */
    public function getBuyOrders()
    {
        return [];
    }
}
