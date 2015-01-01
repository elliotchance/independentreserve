<?php

namespace IndependentReserve\Object;

use Concise\TestCase;
use DateTime;

class BitcoinDepositAddressTest extends TestCase
{
    /**
     * @var BitcoinDepositAddress
     */
    protected $address;

    public function setUp()
    {
        parent::setUp();

        $obj = (object)[
            "BitcoinAddress" => "12a7FbBzSGvJd36wNesAxAksLXMWm4oLUJ",
            "LastCheckedTimestampUtc" => "2014-05-05T09:35:22.4032405Z",
            "NextUpdateTimestampUtc" => "2014-05-05T09:45:22.4032405Z",
        ];

        $this->address = BitcoinDepositAddress::createFromObject($obj);
    }

    public function testFactorySetsBitcoinAddress()
    {
        $this->assert($this->address->getBitcoinAddress(), equals, '12a7FbBzSGvJd36wNesAxAksLXMWm4oLUJ');
    }

    public function testLastCheckedTimestampIsADateTime()
    {
        $this->assert($this->address->getLastCheckedTimestamp(), instance_of, '\DateTime');
    }

    public function testNextUpdateTimestampIsADateTime()
    {
        $this->assert($this->address->getNextUpdateTimestamp(), instance_of, '\DateTime');
    }

    public function testFactorySetsLastCheckedTimestamp()
    {
        $this->assert($this->address->getLastCheckedTimestamp(), equals, new DateTime('2014-05-05T09:35:22.4032405Z'));
    }
}
