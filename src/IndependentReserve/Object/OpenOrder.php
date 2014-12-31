<?php

namespace IndependentReserve\Object;

class OpenOrder extends AbstractOrder
{
    /**
     * Unfilled volume still outstanding on this order.
     * @return double
     */
    public function getOutstanding()
    {
        return $this->object->Outstanding;
    }

    /**
     * The original volume ordered.
     * @return double
     */
    public function getVolume()
    {
        return $this->object->Volume;
    }
}
