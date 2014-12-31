<?php

namespace IndependentReserve\Object;

class SimpleOrder extends AbstractObject
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
     * @return string
     */
    public function getType()
    {
        return $this->object->OrderType;
    }

    /**
     * @return double
     */
    public function getVolume()
    {
        return $this->object->Volume;
    }
}
