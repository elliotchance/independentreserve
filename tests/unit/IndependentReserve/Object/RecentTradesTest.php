<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class RecentTradesTest extends TestCase
{
    /**
     * @var RecentTrades
     */
    protected $recentTrades;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "CreatedTimestampUtc" => "2014-08-05T09:14:39.4830696Z",
            "PrimaryCurrencyCode" => "Xbt",
            "SecondaryCurrencyCode" => "Usd",
            "Trades" => [
                (object)[
                    "PrimaryCurrencyAmount" => 1.00000000,
                    "SecondaryCurrencyTradePrice" => 510.00000000,
                    "TradeTimestampUtc" => "2014-07-31T10:34:05.935412Z"
                ],
                (object)[
                    "PrimaryCurrencyAmount" => 0.01000000,
                    "SecondaryCurrencyTradePrice" => 501.000000,
                    "TradeTimestampUtc" => "2014-07-31T10:33:24.8458426Z"
                ]
            ]
        ];

        $this->recentTrades = RecentTrades::createFromObject($obj);
    }

    public function testFactorySetsPrimaryCurrencyCode()
    {
        $this->assert($this->recentTrades->getPrimaryCurrencyCode(), equals, 'Xbt');
    }

    public function testFactorySetsSecondaryCurrencyCode()
    {
        $this->assert($this->recentTrades->getSecondaryCurrencyCode(), equals, 'Usd');
    }

    public function testCreatedTimestampIsADateTime()
    {
        $this->assert($this->recentTrades->getCreatedTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTimestamp()
    {
        $this->assert($this->recentTrades->getCreatedTimestamp(), equals, new DateTime("2014-08-05T09:14:39.4830696Z"));
    }

    public function testTradesIsAnArray()
    {
        $this->assert($this->recentTrades->getTrades(), is_an_array);
    }

    public function testFactorySetsSingleTrade()
    {
        $trades = $this->recentTrades->getTrades();
        $this->assert($trades[0], instance_of, '\IndependentReserve\Object\Trade');
    }

    public function testFactorySetsAllTrades()
    {
        $trades = $this->recentTrades->getTrades();
        $this->assert($trades[1], instance_of, '\IndependentReserve\Object\Trade');
    }
}
