<?php

namespace IndependentReserve\Object;

class ClosedOrder extends AbstractOrder
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
     * @return double
     */
    public function getAveragePrice()
    {
        return $this->object->AvgPrice;
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
