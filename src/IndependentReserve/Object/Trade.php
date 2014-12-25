<?php

namespace IndependentReserve\Object;

use DateTime;

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

    /**
     * UTC timestamp of trade.
     * @return DateTime
     */
    public function getTradeTimestamp()
    {
        return new DateTime($this->object->TradeTimestampUtc);
    }
}
