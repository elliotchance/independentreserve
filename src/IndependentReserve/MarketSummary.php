<?php

namespace IndependentReserve;

use DateTime;
use stdClass;

class MarketSummary
{
    /**
     * @var object
     */
    protected $object;

    /**
     * @param stdClass $object Original object from the API to be translated.
     * @return MarketSummary
     */
    public static function createFromObject(stdClass $object)
    {
        $marketSummary = new self();
        $marketSummary->object = $object;
        return $marketSummary;
    }

    /**
     * UTC timestamp of when the market summary was generated.
     * @return DateTime
     */
    public function getCreatedTimestamp()
    {
        return new DateTime($this->object->CreatedTimestampUtc);
    }

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
}
