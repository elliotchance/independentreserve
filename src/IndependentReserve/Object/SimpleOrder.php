<?php

namespace IndependentReserve\Object;

class SimpleOrder extends AbstractOrder
{
    /**
     * @return string
     * @override
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
