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

    public function testFilled()
    {
        $this->assert(OrderStatus::FILLED, equals, 'Filled');
    }

    public function testPartiallyFilledAndCancelled()
    {
        $this->assert(OrderStatus::PARTIALLY_FILLED_AND_CANCELLED, equals, 'PartiallyFilledAndCancelled');
    }

    public function testCancelled()
    {
        $this->assert(OrderStatus::CANCELLED, equals, 'Cancelled');
    }

    public function testPartiallyFilledAndExpired()
    {
        $this->assert(OrderStatus::PARTIALLY_FILLED_AND_EXPIRED, equals, 'PartiallyFilledAndExpired');
    }
}
