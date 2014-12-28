<?php

namespace IndependentReserve\Object;

use DateTime;

class Order extends AbstractOrder
{
    /**
     * UTC timestamp of when the data was generated.
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
    public function getOrderGuid()
    {
        return $this->object->OrderGuid;
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
     * The amount of funds reserved in your account by this order.
     * @return double
     */
    public function getReservedAmount()
    {
        return $this->object->ReservedAmount;
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
     * @see \IndependentReserve\OrderStatus::FILLED
     * @return string
     */
    public function getStatus()
    {
        return $this->object->Status;
    }

    /**
     * Volume already filled on this order.
     * @return double
     */
    public function getVolumeFilled()
    {
        return $this->object->VolumeFilled;
    }

    /**
     * The original volume ordered.
     * @return double
     */
    public function getVolumeOrdered()
    {
        return $this->object->VolumeOrdered;
    }
}
