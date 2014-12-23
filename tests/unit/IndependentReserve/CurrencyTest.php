<?php

namespace IndependentReserve;

use Concise\TestCase;

class CurrencyTest extends TestCase
{
    public function testXbt()
    {
        $this->assert(Currency::XBT, equals, 'Xbt');
    }

    public function testUsd()
    {
        $this->assert(Currency::USD, equals, 'Usd');
    }

    public function testAud()
    {
        $this->assert(Currency::AUD, equals, 'Aud');
    }
}
