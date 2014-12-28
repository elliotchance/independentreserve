<?php

namespace IndependentReserve;

use Concise\TestCase;

class OrderTypeTest extends TestCase
{
    public function testLimitBid()
    {
        $this->assert(OrderType::LIMIT_BID, equals, 'LimitBid');
    }

    public function testLimitOffer()
    {
        $this->assert(OrderType::LIMIT_OFFER, equals, 'LimitOffer');
    }

    public function testMarketBid()
    {
        $this->assert(OrderType::MARKET_BID, equals, 'MarketBid');
    }
}
