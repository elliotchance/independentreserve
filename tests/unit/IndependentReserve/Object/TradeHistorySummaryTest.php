<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class TradeHistorySummaryTest extends TestCase
{
    /**
     * @var TradeHistorySummary
     */
    protected $tradeHistorySummary;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "CreatedTimestampUtc" => "2014-08-05T09:02:57.5440691Z",
            "HistorySummaryItems" => [
                (object)[
                    "AverageSecondaryCurrencyPrice" => 510.00000000,
                    "ClosingSecondaryCurrencyPrice" => 510.00000000,
                    "StartTimestampUtc" => "2014-08-04T09:00:00Z",
                    "EndTimestampUtc" => "2014-08-04T10:00:00Z",
                    "HighestSecondaryCurrencyPrice" => 510.00000000,
                    "LowestSecondaryCurrencyPrice" => 510.00000000,
                    "NumberOfTrades" => 0,
                    "OpeningSecondaryCurrencyPrice" => 510.00000000,
                    "PrimaryCurrencyVolume" => 0.00000000,
                    "SecondaryCurrencyVolume" => 0.00000000,
                ]
            ],
            "NumberOfHoursInThePastToRetrieve" => 1,
            "PrimaryCurrencyCode" => "Xbt",
            "SecondaryCurrencyCode" => "Usd",
        ];

        $this->tradeHistorySummary = TradeHistorySummary::createFromObject($obj);
    }

    public function testCreatedTimestampIsADateTime()
    {
        $this->assert($this->tradeHistorySummary->getCreatedTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTime()
    {
        $this->assert($this->tradeHistorySummary->getCreatedTimestamp(), equals, new DateTime("2014-08-05T09:02:57.5440691Z"));
    }

    public function testFactorySetsPrimaryCurrencyCode()
    {
        $this->assert($this->tradeHistorySummary->getPrimaryCurrencyCode(), equals, 'Xbt');
    }

    public function testFactorySetsSecondaryCurrencyCode()
    {
        $this->assert($this->tradeHistorySummary->getSecondaryCurrencyCode(), equals, 'Usd');
    }

    public function testFactorySetsNumberOfHoursInThePastToRetrieve()
    {
        $this->assert($this->tradeHistorySummary->getNumberOfHoursInThePastToRetrieve(), equals, 1);
    }

    public function testHistorySummaryItemsMustBeAnArray()
    {
        $this->assert($this->tradeHistorySummary->getHistorySummaryItems(), is_an_array);
    }

    public function testFactorySetsSingleHistorySummaryItem()
    {
        $items = $this->tradeHistorySummary->getHistorySummaryItems();
        $this->assert($items[0], instance_of, '\IndependentReserve\Object\HistorySummaryItem');
    }
}
