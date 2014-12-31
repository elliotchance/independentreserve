<?php

namespace IndependentReserve\Object;

class Order extends AbstractOrder
{
    /**
     * The amount of funds reserved in your account by this order.
     * @return double
     */
    public function getReservedAmount()
    {
        return $this->object->ReservedAmount;
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
