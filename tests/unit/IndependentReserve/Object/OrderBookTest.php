<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class OrderBookTest extends TestCase
{
    /**
     * @var OrderBook
     */
    protected $orderBook;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "BuyOrders" => [
                [
                    "OrderType" => "LimitBid",
                    "Price" => 497.02000000,
                    "Volume" => 0.01000000
                ],
                [
                    "OrderType" => "LimitBid",
                    "Price" => 490.00000000,
                    "Volume" => 1.00000000
                ]
            ],
            "CreatedTimestampUtc" => "2014-08-05T06:42:11.3032208Z",
            "PrimaryCurrencyCode" => "Xbt",
            "SecondaryCurrencyCode" => "Usd",
            "SellOrders" => [
                [
                    "OrderType" => "LimitOffer",
                    "Price" => 500.00000000,
                    "Volume" => 1.00000000
                ],
                [
                    "OrderType" => "LimitOffer",
                    "Price" => 505.00000000,
                    "Volume" => 1.00000000
                ]
            ]
        ];

        $this->order = OrderBook::createFromObject($obj);
    }

    public function testCreatedTimestampIsADateTime()
    {
        $this->assert($this->order->getCreatedTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTime()
    {
        $this->assert($this->order->getCreatedTimestamp(), equals, new DateTime("2014-08-05T06:42:11.3032208Z"));
    }
}
