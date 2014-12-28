<?php

namespace IndependentReserve\Object;

class LimitOrder extends AbstractTimestampedObject
{
    /**
     * Unique identifier of the order.
     * @return string
     */
    public function getOrderGuid()
    {
        return $this->object->OrderGuid;
    }

    /**
     * Order limit price in secondary currency.
     * @return double
     */
    public function getPrice()
    {
        return $this->object->Price;
    }
}
