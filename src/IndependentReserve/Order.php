<?php

namespace IndependentReserve;

class Order extends AbstractObject
{
    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->object->OrderType;
    }

    /**
     * @return double
     */
    public function getPrice()
    {
        return $this->object->Price;
    }

    /**
     * @return double
     */
    public function getVolume()
    {
        return $this->object->Volume;
    }
}
