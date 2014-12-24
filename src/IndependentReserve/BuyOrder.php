<?php

namespace IndependentReserve;

use stdClass;

class BuyOrder
{
    /**
     * @var object
     */
    protected $object;

    /**
     * @param stdClass $object Original object from the API to be translated.
     * @return BuyOrder
     */
    public static function createFromObject(stdClass $object)
    {
        $buyOrder = new self();
        $buyOrder->object = $object;
        return $buyOrder;
    }

    /**
     * @return string
     */
    public function getOrderType()
    {
        return $this->object->OrderType;
    }
}
