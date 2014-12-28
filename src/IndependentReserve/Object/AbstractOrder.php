<?php

namespace IndependentReserve\Object;

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
     * Type of order.
     * @see \IndependentReserve\OrderType
     * @return string
     */
    public function getType()
    {
        return $this->object->Type;
    }
}
