<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

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
            "OrderType" => "LimitBid",
            "Price" => 497.02000000,
            "Volume" => 0.01000000,
        ];

        $this->order = Order::createFromObject($obj);
    }

    public function testFactorySetsOrderType()
    {
        $this->assert($this->order->getOrderType(), equals, 'LimitBid');
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
