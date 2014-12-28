<?php

namespace IndependentReserve\Object;

class MarketSummary extends AbstractTimestampedObject
{
    /**
     * Current highest bid on order book.
     * @return float
     */
    public function getCurrentHighestBidPrice()
    {
        return $this->object->CurrentHighestBidPrice;
    }

    /**
     * Current lowest offer on order book.
     * @return float
     */
    public function getCurrentLowestOfferPrice()
    {
        return $this->object->CurrentLowestOfferPrice;
    }

    /**
     * Weighted average traded price over last 24 hours.
     * @return double
     */
    public function getDayAveragePrice()
    {
        return $this->object->DayAvgPrice;
    }

    /**
     * Highest traded price over last 24 hours.
     * @return double
     */
    public function getDayHighestPrice()
    {
        return $this->object->DayHighestPrice;
    }

    /**
     * Lowest traded price over last 24 hours.
     * @return double
     */
    public function getDayLowestPrice()
    {
        return $this->object->DayLowestPrice;
    }

    /**
     * Volume of primary currency traded in last 24 hours.
     * @return double
     */
    public function getDayVolumeXbt()
    {
        return $this->object->DayVolumeXbt;
    }

    /**
     * Last traded price.
     * @return double
     */
    public function getLastPrice()
    {
        return $this->object->LastPrice;
    }

    /**
     * The primary currency being summarised.
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
