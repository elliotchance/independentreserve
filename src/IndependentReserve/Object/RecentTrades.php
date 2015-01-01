<?php

namespace IndependentReserve\Object;

use stdClass;

class RecentTrades extends AbstractTimestampedObject
{
    /**
     * The primary currency being shown.
     * @return string
     */
    public function getPrimaryCurrencyCode()
    {
        return $this->object->PrimaryCurrencyCode;
    }

    /**
     * The secondary currency being used for pricing.
     * @return string
     */
    public function getSecondaryCurrencyCode()
    {
        return $this->object->SecondaryCurrencyCode;
    }

    /**
     * List of individual trades.
     * @return array
     */
    public function getTrades()
    {
        return array_map(function (stdClass $object) {
            return Trade::createFromObject($object);
        }, $this->object->Trades);
    }
}
