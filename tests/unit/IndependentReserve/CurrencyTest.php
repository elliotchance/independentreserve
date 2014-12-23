<?php

namespace IndependentReserve;

use Concise\TestCase;

class CurrencyTest extends TestCase
{
    public function testXbt()
    {
        $this->assert(Currency::XBT, equals, 'Xbt');
    }
}
