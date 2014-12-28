<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;
use IndependentReserve\OrderType;

class SimpleOrderTest extends TestCase
{
    /**
     * @var SimpleOrder
     */
    protected $order;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "OrderType" => "LimitBid",
            "Price" => 497.02000000,
            "Volume" => 0.01000000,
        ];

        $this->order = SimpleOrder::createFromObject($obj);
    }

    public function testFactorySetsOrderType()
    {
        $this->assert($this->order->getType(), equals, OrderType::LIMIT_BID);
    }

    public function testFactorySetsPrice()
    {
        $this->assert($this->order->getPrice(), equals, 497.02);
    }

    public function testFactorySetsVolume()
    {
        $this->assert($this->order->getVolume(), equals, 0.01);
    }
}
