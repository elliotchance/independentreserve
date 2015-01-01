<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;
use IndependentReserve\OrderType;

class OrderTest extends TestCase
{
    /**
     * @var Order
     */
    protected $order;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "CreatedTimestampUtc" => "2014-08-05T06:42:11.3032208Z",
            "OrderGuid" => "719c495c-a39e-4884-93ac-280b37245037",
            "Price" => 485.76,
            "PrimaryCurrencyCode" => "Xbt",
            "ReservedAmount" => 0.358,
            "SecondaryCurrencyCode" => "Usd",
            "Status" => "Open",
            "Type" => "LimitOffer",
            "VolumeFilled" => 0,
            "VolumeOrdered" => 0.358,
        ];

        $this->order = Order::createFromObject($obj);
    }

    public function testCreatedTimestampIsADateTime()
    {
        $this->assert($this->order->getCreatedTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsCreatedTimestamp()
    {
        $this->assert($this->order->getCreatedTimestamp(), equals, new DateTime("2014-08-05T06:42:11.3032208Z"));
    }

    public function testFactorySetsOrderGuid()
    {
        $this->assert($this->order->getGuid(), equals, '719c495c-a39e-4884-93ac-280b37245037');
    }

    public function testFactorySetsPrice()
    {
        $this->assert($this->order->getPrice(), equals, 485.76);
    }

    public function testFactorySetsPrimaryCurrencyCode()
    {
        $this->assert($this->order->getPrimaryCurrencyCode(), equals, 'Xbt');
    }

    public function testFactorySetsReservedAmount()
    {
        $this->assert($this->order->getReservedAmount(), equals, 0.358);
    }

    public function testFactorySetsSecondaryCurrencyCode()
    {
        $this->assert($this->order->getSecondaryCurrencyCode(), equals, 'Usd');
    }

    public function testFactorySetsStatus()
    {
        $this->assert($this->order->getStatus(), equals, 'Open');
    }

    public function testFactorySetsType()
    {
        $this->assert($this->order->getType(), equals, OrderType::LIMIT_OFFER);
    }

    public function testFactorySetsVolumeFilled()
    {
        $this->assert($this->order->getVolumeFilled(), equals, 0);
    }

    public function testFactorySetsVolumeOrdered()
    {
        $this->assert($this->order->getVolumeOrdered(), equals, 0.358);
    }
}
