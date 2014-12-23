<?php

namespace IndependentReserve;

use Concise\TestCase;

class IndependentReserveClientIntegrationTest extends TestCase
{
    public function testGetValidPrimaryCurrencyCodes()
    {
        $client = new IndependentReserveClient();
        $currencyCodes = $client->getValidPrimaryCurrencyCodes();
        $this->assert($currencyCodes, equals, ["Xbt"]);
    }
}
