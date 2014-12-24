<?php

namespace IndependentReserve;

use Concise\TestCase;

class MarketSummaryTest extends TestCase
{
    public function testCreatedTimestampUtcReturnsADateTime()
    {
        $obj = (object)[
            "CreatedTimestampUtc" => "2014-08-05T06:42:11.3032208Z",
            "CurrentHighestBidPrice" => 500.00000000,
            "CurrentLowestOfferPrice" => 1001.00000000,
            "DayAvgPrice" => 510.000000,
            "DayHighestPrice" => 510.00000000,
            "DayLowestPrice" => 510.00000000,
            "DayVolumeXbt" => 1.00000000,
            "LastPrice" => 510.00000000,
            "PrimaryCurrencyCode" => "Xbt",
            "SecondaryCurrencyCode" => "Usd",
        ];

        $marketSummary = MarketSummary::createFromObject($obj);
        $this->assert($marketSummary->getCreatedTimestampUtc(), instance_of, '\DateTime');
    }
}
