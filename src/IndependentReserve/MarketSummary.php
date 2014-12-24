<?php

namespace IndependentReserve;

use DateTime;
use stdClass;

class MarketSummary
{
    /**
     * UTC timestamp of when the market summary was generated.
     * @var DateTime
     */
    protected $createdTimestampUtc;

    /**
     * Current highest bid on order book.
     * @var double
     */
    protected $currentHighestBidPrice;

    /**
     * @param stdClass $object Original object from the API to be translated.
     * @return MarketSummary
     */
    public static function createFromObject(stdClass $object)
    {
        $marketSummary = new self();
        $marketSummary->createdTimestampUtc = new DateTime($object->CreatedTimestampUtc);
        $marketSummary->currentHighestBidPrice = $object->CurrentHighestBidPrice;
        return $marketSummary;
    }

    /**
     * UTC timestamp of when the market summary was generated.
     * @return DateTime
     */
    public function getCreatedTimestampUtc()
    {
        return $this->createdTimestampUtc;
    }

    /**
     * Current highest bid on order book.
     * @return float
     */
    public function getCurrentHighestBidPrice()
    {
        return $this->currentHighestBidPrice;
    }
}
