<?php

namespace IndependentReserve;

use stdClass;

abstract class AbstractObject
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
        $buyOrder = new static();
        $buyOrder->object = $object;
        return $buyOrder;
    }
}
