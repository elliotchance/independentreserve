<?php

namespace IndependentReserve\Object;

use DateTime;

class HistorySummaryItem extends AbstractObject
{
    /**
     * Average traded price during hour.
     * @return double
     */
    public function getAverageSecondaryCurrencyPrice()
    {
        return $this->object->AverageSecondaryCurrencyPrice;
    }

    /**
     * Last traded price in hour.
     * @return double
     */
    public function getClosingSecondaryCurrencyPrice()
    {
        return $this->object->ClosingSecondaryCurrencyPrice;
    }

    /**
     * Highest traded price during hour.
     * @return double
     */
    public function getHighestSecondaryCurrencyPrice()
    {
        return $this->object->HighestSecondaryCurrencyPrice;
    }

    /**
     * Lowest traded price during hour.
     * @return double
     */
    public function getLowestSecondaryCurrencyPrice()
    {
        return $this->object->LowestSecondaryCurrencyPrice;
    }

    /**
     * Number of trades executed during hour.
     * @return int
     */
    public function getNumberOfTrades()
    {
        return $this->object->NumberOfTrades;
    }

    /**
     * Opening traded price at start of hour.
     * @return double
     */
    public function getOpeningSecondaryCurrencyPrice()
    {
        return $this->object->OpeningSecondaryCurrencyPrice;
    }

    /**
     * Volume of primary currency trade during hour.
     * @return double
     */
    public function getPrimaryCurrencyVolume()
    {
        return $this->object->PrimaryCurrencyVolume;
    }

    /**
     * Volume of secondary currency traded during hour.
     * @return double
     */
    public function getSecondaryCurrencyVolume()
    {
        return $this->object->AverageSecondaryCurrencyPrice;
    }

    /**
     * UTC Start time of hour.
     * @return DateTime
     */
    public function getStartTimestamp()
    {
        return new DateTime($this->object->StartTimestampUtc);
    }

    /**
     * UTC End time of hour.
     * @return DateTime
     */
    public function getEndTimestamp()
    {
        return new DateTime($this->object->EndTimestampUtc);
    }
}
