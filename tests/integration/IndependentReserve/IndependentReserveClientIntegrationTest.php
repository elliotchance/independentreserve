<?php

namespace IndependentReserve;

use Concise\TestCase;

class IndependentReserveClientIntegrationTest extends TestCase
{
    /**
     * @var IndependentReserveClient
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new IndependentReserveClient();
    }

    public function testGetValidPrimaryCurrencyCodes()
    {
        $currencyCodes = $this->client->getValidPrimaryCurrencyCodes();
        $this->assert($currencyCodes, equals, ["Xbt"]);
    }

    public function testGetValidSecondaryCurrencyCodes()
    {
        $currencyCodes = $this->client->getValidSecondaryCurrencyCodes();
        $this->assert($currencyCodes, has_value, "Usd");
    }

    public function testGetValidLimitOrderTypes()
    {
        $orderTypes = $this->client->getGetValidLimitOrderTypes();
        $this->assert($orderTypes, equals, ["LimitBid","LimitOffer"]);
    }
}
