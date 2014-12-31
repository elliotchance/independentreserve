<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;
use IndependentReserve\OrderType;

class OpenOrderTest extends TestCase
{
    /**
     * @var OpenOrder
     */
    protected $order;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "CreatedTimestampUtc" => "2014-08-05T06:42:11.3032208Z",
            "EstimatedValue" => 10006.31,
            "OrderGuid" => "dd015a29-8f73-4469-a5fa-ea91544dfcda",
            "OrderType" => "LimitOffer",
            "Outstanding" => 21.45621,
            "Price" => 466.36000000,
            "PrimaryCurrencyCode" => "Xbt",
            "SecondaryCurrencyCode" => "Usd",
            "Status" => "Open",
            "Volume" => 21.45621000,
        ];

        $this->order = OpenOrder::createFromObject($obj);
    }

    public function testCreatedTimestampIsADateTime()
    {
        $this->assert($this->order->getCreatedTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTimestamp()
    {
        $this->assert($this->order->getCreatedTimestamp(), equals, new DateTime("2014-08-05T06:42:11.3032208Z"));
    }

    public function testFactorySetsEstimatedValue()
    {
        $this->assert($this->order->getEstimatedValue(), equals, 10006.31);
    }

    public function testFactorySetsOrderGuid()
    {
        $this->assert($this->order->getOrderGuid(), equals, 'dd015a29-8f73-4469-a5fa-ea91544dfcda');
    }

    public function testFactorySetsType()
    {
        $this->assert($this->order->getType(), equals, OrderType::LIMIT_OFFER);
    }

    public function testFactorySetsOutstanding()
    {
        $this->assert($this->order->getOutstanding(), equals, 21.45621);
    }

    public function testFactorySetsPrice()
    {
        $this->assert($this->order->getPrice(), equals, 466.36);
    }

    public function testFactorySetsPrimaryCurrencyCode()
    {
        $this->assert($this->order->getPrimaryCurrencyCode(), equals, 'Xbt');
    }

    public function testFactorySetsSecondaryCurrencyCode()
    {
        $this->assert($this->order->getSecondaryCurrencyCode(), equals, 'Usd');
    }

    public function testFactorySetsStatus()
    {
        $this->assert($this->order->getStatus(), equals, 'Open');
    }

    public function testFactorySetsVolume()
    {
        $this->assert($this->order->getVolume(), equals, 21.45621);
    }
}
