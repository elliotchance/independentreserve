<?php

namespace IndependentReserve;

use Concise\TestCase;

class OrderStatusTest extends TestCase
{
    public function testOpen()
    {
        $this->assert(OrderStatus::OPEN, equals, 'Open');
    }

    public function testPartiallyFilled()
    {
        $this->assert(OrderStatus::PARTIALLY_FILLED, equals, 'PartiallyFilled');
    }
}
