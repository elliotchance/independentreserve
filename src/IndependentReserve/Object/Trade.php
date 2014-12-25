<?php

namespace IndependentReserve\Object;

class Trade extends AbstractObject
{
    /**
     * Amount traded in primary currency.
     * @return double
     */
    public function getPrimaryCurrencyAmount()
    {
        return $this->object->PrimaryCurrencyAmount;
    }

    /**
     * Amount traded in secondary currency.
     * @return double
     */
    public function getSecondaryCurrencyTradePrice()
    {
        return $this->object->SecondaryCurrencyTradePrice;
    }
}
