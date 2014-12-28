<?php

namespace IndependentReserve;

use Concise\TestCase;

class OrderTypeTest extends TestCase
{
    public function testLimitBid()
    {
        $this->assert(OrderType::LIMIT_BID, equals, 'LimitBid');
    }
}
