<?php

namespace IndependentReserve;

use Concise\TestCase;
use DateTime;

class BuyOrderTest extends TestCase
{
    /**
     * @var BuyOrder
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

        $this->order = BuyOrder::createFromObject($obj);
    }

    public function testFactorySetsOrderType()
    {
        $this->assert($this->order->getOrderType(), equals, 'LimitBid');
    }

    public function testFactorySetsPrice()
    {
        $this->assert($this->order->getPrice(), equals, 497.02);
    }
}
