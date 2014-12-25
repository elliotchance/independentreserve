<?php

namespace IndependentReserve\Object;

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
}
