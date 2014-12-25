<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class TradeTest extends TestCase
{
    /**
     * @var Trade
     */
    protected $trade;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "PrimaryCurrencyAmount" => 1.00000000,
            "SecondaryCurrencyTradePrice" => 510.00000000,
            "TradeTimestampUtc" => "2014-07-31T10:34:05.935412Z",
        ];

        $this->trade = Trade::createFromObject($obj);
    }

    public function testFactorySetsPrimaryCurrencyAmount()
    {
        $this->assert($this->trade->getPrimaryCurrencyAmount(), equals, 1);
    }

    public function testFactorySetsSecondaryCurrencyTradePrice()
    {
        $this->assert($this->trade->getSecondaryCurrencyTradePrice(), equals, 510);
    }

    public function testTradeTimestampIsADateTime()
    {
        $this->assert($this->trade->getTradeTimestamp(), instance_of, '\DateTime');
    }
}
