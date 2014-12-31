<?php

namespace IndependentReserve;

use Concise\TestCase;
use DateTime;

class ClientIntegrationPrivateTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * @return array
     */
    protected function getConfig()
    {
        $config = [];
        $configFile = __DIR__ . '/../../../config.ini';
        if (file_exists($configFile)) {
            $config = parse_ini_file($configFile);
        }
        foreach (['API_KEY', 'API_SECRET'] as $variable) {
            if (getenv($variable)) {
                $config[$variable] = getenv($variable);
            }
        }
        return $config;
    }

    public function setUp()
    {
        parent::setUp();
        $config = $this->getConfig();
        $this->client = new Client($config['API_KEY'], $config['API_SECRET']);
    }

    public function testPlaceLimitOrder()
    {
        $this->markTestIncomplete("No USD available.");

        $result = $this->client->placeLimitOrder(Currency::XBT, Currency::USD, 1000, 0.01);
        $this->assert($result, instance_of, '\IndependentReserve\Object\Order');
    }

    public function testGetOpenOrders()
    {
        $openOrders = $this->client->getOpenOrders(Currency::XBT, Currency::USD);
        $this->assert($openOrders, instance_of, '\Elliotchance\Iterator\AbstractPagedIterator');

        $this->assert(count($openOrders), equals, 1);
        $this->verify($openOrders[0]->getCreatedTimestamp(), equals, new DateTime("2014-12-30T23:02:27.0640799Z"));
        $this->verify($openOrders[0]->getType(), equals, OrderType::LIMIT_OFFER);
        $this->verify($openOrders[0]->getVolume(), equals, 0.01);
        $this->verify($openOrders[0]->getOutstanding(), is_greater_than, 0);
        $this->verify($openOrders[0]->getPrice(), is_greater_than, 0);
        $this->verify($openOrders[0]->getVolume(), is_greater_than, 0);
        $this->verify($openOrders[0]->getGuid(), matches_regex, '/[a-f\d]{8}-[a-f\d]{4}-[a-f\d]{4}-[a-f\d]{4}-[a-f\d]{12}/');
        $this->verify($openOrders[0]->getPrimaryCurrencyCode(), equals, Currency::XBT);
        $this->verify($openOrders[0]->getSecondaryCurrencyCode(), equals, Currency::USD);
    }

    public function testPlaceMarketOrder()
    {
        $this->markTestIncomplete("No USD available.");

        $result = $this->client->placeMarketOrder(Currency::XBT, Currency::USD, 1000);
        $this->assert($result, instance_of, '\IndependentReserve\Object\Order');
    }
}
