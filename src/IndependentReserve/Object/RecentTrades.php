<?php

namespace IndependentReserve\Object;

use DateTime;
use stdClass;

class RecentTrades extends AbstractObject
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
     * UTC timestamp of when the data was generated.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime($this->object->CreatedTimestampUtc);
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
