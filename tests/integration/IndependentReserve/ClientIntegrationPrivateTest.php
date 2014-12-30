<?php

namespace IndependentReserve;

use Concise\TestCase;

class ClientIntegrationPrivateTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $config = parse_ini_file(__DIR__ . '/../../../config.ini');
        foreach (['API_KEY', 'API_SECRET'] as $variable) {
            if (getenv($variable)) {
                $config[$variable] = getenv($variable);
            }
        }
        $this->client = new Client($config['API_KEY'], $config['API_SECRET']);
    }

    public function testGetOpenOrders()
    {
        $openOrders = $this->client->getOpenOrders(Currency::XBT, Currency::USD);
        $this->assert($openOrders, instance_of, '\Elliotchance\Iterator\AbstractPagedIterator');

        $this->assert(count($openOrders), equals, 0);
    }
}
