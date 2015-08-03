<?php

namespace IndependentReserve\Object;

use DateTime;

abstract class AbstractOrder extends AbstractObject
{
    /**
     * Order limit price in secondary currency.
     * @return double
     */
    public function getPrice()
    {
        return $this->object->Price;
    }
    
    /**
     * Volume ordered.
     * @return double
     */
    public function getVolume()
    {
        return $this->object->Volume;
    }

    /**
     * Type of order.
     * @see \IndependentReserve\OrderType
     * @return string
     */
    public function getType()
    {
        if (isset($this->object->Type)) {
            return $this->object->Type;
        }
        return $this->object->OrderType;
    }

    /**
     * UTC timestamp of when order was created.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime($this->object->CreatedTimestampUtc);
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
     * @return string
     */
    public function getStatus()
    {
        return $this->object->Status;
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
