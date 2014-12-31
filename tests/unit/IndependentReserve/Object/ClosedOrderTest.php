<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;
use IndependentReserve\OrderType;

class ClosedOrderTest extends TestCase
{
    /**
     * @var ClosedOrder
     */
    protected $order;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "AvgPrice" => 698.8,
            "CreatedTimestampUtc" => "2014-08-05T06:42:11.3032208Z",
            "OrderGuid" => "5c8885cd-5384-4e05-b397-9f5119353e10",
            "OrderType" => "MarketOffer",
            "Outstanding" => 0,
            "PrimaryCurrencyCode" => "Xbt",
            "SecondaryCurrencyCode" => "Usd",
            "Status" => "Filled",
            "Value" => 17.47,
            "Volume" => 0.02500000,
        ];

        $this->order = ClosedOrder::createFromObject($obj);
    }

    public function testCreatedTimestampIsADateTime()
    {
        $this->assert($this->order->getCreatedTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTimestamp()
    {
        $this->assert($this->order->getCreatedTimestamp(), equals, new DateTime("2014-08-05T06:42:11.3032208Z"));
    }

    public function testFactorySetsGuid()
    {
        $this->assert($this->order->getGuid(), equals, '5c8885cd-5384-4e05-b397-9f5119353e10');
    }

    public function testFactorySetsType()
    {
        $this->assert($this->order->getType(), equals, OrderType::MARKET_OFFER);
    }

    public function testFactorySetsOutstanding()
    {
        $this->assert($this->order->getOutstanding(), equals, 0);
    }

    public function testFactorySetsAveragePrice()
    {
        $this->assert($this->order->getAveragePrice(), equals, 698.8);
    }

    public function testFactorySetsPrimaryCurrencyCode()
    {
        $this->assert($this->order->getPrimaryCurrencyCode(), equals, 'Xbt');
    }

    public function testFactorySetsSecondaryCurrencyCode()
    {
        $this->assert($this->order->getSecondaryCurrencyCode(), equals, 'Usd');
    }
}
