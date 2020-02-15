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

    public function testNzd()
    {
        $this->assert(Currency::NZD, equals, 'Nzd');
    }

    public function testEth()
    {
        $this->assert(Currency::ETH, equals, 'Eth');
    }

    public function testBch()
    {
        $this->assert(Currency::BCH, equals, 'Bch');
    }

    public function testLtc()
    {
        $this->assert(Currency::LTC, equals, 'Ltc');
    }
}

