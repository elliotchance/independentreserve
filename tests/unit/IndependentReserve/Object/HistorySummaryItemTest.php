<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class HistorySummaryItemTest extends TestCase
{
    /**
     * @var HistorySummaryItem
     */
    protected $historySummaryItem;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "AverageSecondaryCurrencyPrice" => 510.00000000,
            "ClosingSecondaryCurrencyPrice" => 510.00000000,
            "StartTimestampUtc" => "2014-08-04T09:00:00Z",
            "EndTimestampUtc" => "2014-08-04T10:00:00Z",
            "HighestSecondaryCurrencyPrice" => 510.00000000,
            "LowestSecondaryCurrencyPrice" => 510.00000000,
            "NumberOfTrades" => 50,
            "OpeningSecondaryCurrencyPrice" => 510.00000000,
            "PrimaryCurrencyVolume" => 0.00000000,
            "SecondaryCurrencyVolume" => 0.00000000,
        ];

        $this->historySummaryItem = HistorySummaryItem::createFromObject($obj);
    }

    public function testFactorySetsAverageSecondaryCurrencyPrice()
    {
        $this->assert($this->historySummaryItem->getAverageSecondaryCurrencyPrice(), equals, 510);
    }

    public function testFactorySetsClosingSecondaryCurrencyPrice()
    {
        $this->assert($this->historySummaryItem->getClosingSecondaryCurrencyPrice(), equals, 510);
    }

    public function testFactorySetsHighestSecondaryCurrencyPrice()
    {
        $this->assert($this->historySummaryItem->getHighestSecondaryCurrencyPrice(), equals, 510);
    }

    public function testFactorySetsLowestSecondaryCurrencyPrice()
    {
        $this->assert($this->historySummaryItem->getLowestSecondaryCurrencyPrice(), equals, 510);
    }

    public function testNumberOfTrades()
    {
        $this->assert($this->historySummaryItem->getNumberOfTrades(), equals, 50);
    }

    public function testFactorySetsOpeningSecondaryCurrencyPrice()
    {
        $this->assert($this->historySummaryItem->getOpeningSecondaryCurrencyPrice(), equals, 510);
    }

    public function testFactorySetsPrimaryCurrencyVolume()
    {
        $this->assert($this->historySummaryItem->getPrimaryCurrencyVolume(), equals, 0);
    }

    public function testFactorySetsSecondaryCurrencyVolume()
    {
        $this->assert($this->historySummaryItem->getSecondaryCurrencyVolume(), equals, 510);
    }

    public function testFactorySetsStartTimestamp()
    {
        $this->assert($this->historySummaryItem->getStartTimestamp(), equals, new DateTime("2014-08-04T09:00:00Z"));
    }

    public function testFactorySetsEndTimestamp()
    {
        $this->assert($this->historySummaryItem->getEndTimestamp(), equals, new DateTime("2014-08-04T10:00:00Z"));
    }
}
