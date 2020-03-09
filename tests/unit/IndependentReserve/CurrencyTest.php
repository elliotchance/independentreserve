<?php

namespace IndependentReserve;

use Concise\TestCase;

class CurrencyTest extends TestCase
{
    public function testAud()
    {
        $this->assert(Currency::AUD, equals, 'Aud');
    }

    public function testUsd()
    {
        $this->assert(Currency::USD, equals, 'Usd');
    }

    public function testNzd()
    {
        $this->assert(Currency::NZD, equals, 'Nzd');
    }

    public function testXbt()
    {
        $this->assert(Currency::XBT, equals, 'Xbt');
    }

    public function testEth()
    {
        $this->assert(Currency::ETH, equals, 'Eth');
    }

    public function testXrp()
    {
        $this->assert(Currency::XRP, equals, 'Xrp');
    }

    public function testXrp()
    {
        $this->assert(Currency::XRP, equals, 'Xrp');
    }

    public function testBch()
    {
        $this->assert(Currency::BCH, equals, 'Bch');
    }

    public function testBsv()
    {
        $this->assert(Currency::BSV, equals, 'Bsv');
    }

    public function testUsdt()
    {
        $this->assert(Currency::USDT, equals, 'Usdt');
    }

    public function testUsdt()
    {
        $this->assert(Currency::USDT, equals, 'Usdt');
    }

    public function testLtc()
    {
        $this->assert(Currency::LTC, equals, 'Ltc');
    }

    public function testEos()
    {
        $this->assert(Currency::EOS, equals, 'Eos');
    }

    public function testXlm()
    {
        $this->assert(Currency::XLM, equals, 'Xlm');
    }

    public function testEtc()
    {
        $this->assert(Currency::ETC, equals, 'Etc');
    }

    public function testBat()
    {
        $this->assert(Currency::BAT, equals, 'Bat');
    }

    public function testOmg()
    {
        $this->assert(Currency::OMG, equals, 'Omg');
    }

    public function testRep()
    {
        $this->assert(Currency::REP, equals, 'Rep');
    }

    public function testZrx()
    {
        $this->assert(Currency::ZRX, equals, 'Zrx');
    }

    public function testGnt()
    {
        $this->assert(Currency::GNT, equals, 'Gnt');
    }

    public function testPla()
    {
        $this->assert(Currency::PLA, equals, 'Pla');
    }
}
