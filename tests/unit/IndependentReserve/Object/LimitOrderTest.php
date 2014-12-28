<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class LimitOrderTest extends TestCase
{
    /**
     * @var LimitOrder
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

        $this->order = LimitOrder::createFromObject($obj);
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
        $this->assert($this->order->getOrderGuid(), equals, '719c495c-a39e-4884-93ac-280b37245037');
    }

    public function testFactorySetsPrice()
    {
        $this->assert($this->order->getPrice(), equals, 485.76);
    }
}
