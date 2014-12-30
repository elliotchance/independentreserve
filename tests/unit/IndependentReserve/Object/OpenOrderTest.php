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
}
