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
}
