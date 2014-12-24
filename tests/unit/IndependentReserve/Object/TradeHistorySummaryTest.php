<?php

namespace IndependentReserve\Object;

use Concise\TestCase;

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
}
