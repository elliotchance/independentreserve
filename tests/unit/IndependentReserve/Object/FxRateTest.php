<?php

namespace IndependentReserve\Object;

use Concise\TestCase;

class FxRateTest extends TestCase
{
    /**
     * @var FxRate
     */
    protected $fxRate;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "CurrencyCodeA" => "Aud",
            "CurrencyCodeB" => "Usd",
            "Rate" => 0.86830000,
        ];

        $this->fxRate = FxRate::createFromObject($obj);
    }

    public function testFactorySetsCurrencyCodeA()
    {
        $this->assert($this->fxRate->getCurrencyCodeA(), equals, 'Aud');
    }

    public function testFactorySetsCurrencyCodeB()
    {
        $this->assert($this->fxRate->getCurrencyCodeB(), equals, 'Usd');
    }
}
