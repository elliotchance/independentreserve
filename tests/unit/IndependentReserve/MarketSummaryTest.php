<?php

namespace IndependentReserve;

use Concise\TestCase;
use DateTime;

class MarketSummaryTest extends TestCase
{
    /**
     * @var MarketSummary
     */
    protected $marketSummary;

    public function setUp()
    {
        parent::setUp();

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

        $this->marketSummary = MarketSummary::createFromObject($obj);
    }

    public function testCreatedTimestampUtcReturnsADateTime()
    {
        $this->assert($this->marketSummary->getCreatedTimestampUtc(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTimestampUtc()
    {
        $this->assert($this->marketSummary->getCreatedTimestampUtc(), equals, new DateTime("2014-08-05T06:42:11.3032208Z"));
    }

    public function testFactorySetsCurrentHighestBidPrice()
    {
        $this->assert($this->marketSummary->getCurrentHighestBidPrice(), equals, 500);
    }
}
