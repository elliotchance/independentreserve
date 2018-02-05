<?php

namespace IndependentReserve;

use Concise\TestCase;
use DateTime;

class ClientIntegrationPrivateTest extends TestCase
{
    const DAY = 86400;

    /**
     * @var PrivateClient
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
        $this->client = new PrivateClient($config['API_KEY'], $config['API_SECRET']);
    }

    public function testPlaceLimitOrder()
    {
        $this->markTestIncomplete("No USD available.");

        $result = $this->client->placeLimitOrder(Currency::XBT, Currency::USD, OrderType::LIMIT_BID, 1000, 0.01);
        $this->assert($result, instance_of, '\IndependentReserve\Object\Order');
    }

    public function testGetOpenOrders()
    {
        $openOrders = $this->client->getOpenOrders(Currency::XBT, Currency::USD);
        $this->assert($openOrders, instance_of, '\Elliotchance\Iterator\AbstractPagedIterator');
        
        // We cannot reliably check the number of open orders as they may change.
    }

    public function testPlaceMarketOrder()
    {
        $this->markTestIncomplete("No USD available.");

        $result = $this->client->placeMarketOrder(Currency::XBT, Currency::USD, OrderType::LIMIT_BID, 1000);
        $this->assert($result, instance_of, '\IndependentReserve\Object\Order');
    }

    public function testCancelOrder()
    {
        $this->markTestSkipped("We must be able to programatically create and order before we can cancel it.");

        $result = $this->client->cancelOrder('fb1e59ae-f285-4b41-8e80-cbf66cd7cac4');
        $this->assert($result, instance_of, '\IndependentReserve\Object\Order');
    }

    public function testGetClosedOrders()
    {
        $this->markTestSkipped(
            'Unfortunately the closed orders expire after a while so it ' .
            'makes this test brittle'
        );

        $closedOrders = $this->client->getClosedOrders(Currency::XBT, Currency::USD);
        $this->assert($closedOrders, instance_of, '\Elliotchance\Iterator\AbstractPagedIterator');

        $this->assert(count($closedOrders), is_greater_than, 0);
        $found = false;
        foreach ($closedOrders as $order) {
            if ($order->getGuid() != '4587abb4-4ba8-4d2d-ae2c-89127db7f686') {
                continue;
            }

            $this->assert($order, instance_of, '\IndependentReserve\Object\ClosedOrder');
            $this->verify($order->getCreatedTimestamp(), equals, new DateTime("2015-01-03 03:04:24.884335Z"));
            $this->verify($order->getType(), equals, OrderType::LIMIT_BID);
            $this->verify($order->getVolume(), equals, 1);
            $this->verify($order->getOutstanding(), equals, 1);
            $this->verify($order->getPrice(), equals, 1);
            $this->verify($order->getAveragePrice(), is_null);
            $this->verify($order->getStatus(), equals, OrderStatus::CANCELLED);
            $this->verify($order->getGuid(), equals, '4587abb4-4ba8-4d2d-ae2c-89127db7f686');
            $this->verify($order->getPrimaryCurrencyCode(), equals, Currency::XBT);
            $this->verify($order->getSecondaryCurrencyCode(), equals, Currency::USD);
            $found = true;
        }

        $this->assert($found);
    }

    public function testGetClosedFilledOrders()
    {
        $this->markTestSkipped(
            'Unfortunately the closed orders expire after a while so it ' .
            'makes this test brittle'
        );
        
        $closedOrders = $this->client->getClosedFilledOrders(Currency::XBT, Currency::USD);
        $this->assert($closedOrders, instance_of, '\Elliotchance\Iterator\AbstractPagedIterator');

        $this->assert(count($closedOrders), is_greater_than, 0);
        $found = false;
        foreach ($closedOrders as $order) {
            if ($order->getGuid() != 'ae1e1dc4-a610-4774-9b97-c3a0b453613b') {
                continue;
            }

            $this->assert($order, instance_of, '\IndependentReserve\Object\ClosedOrder');
            $this->verify($order->getCreatedTimestamp(), equals, new DateTime("2014-12-31 23:23:10.644226Z"));
            $this->verify($order->getType(), equals, OrderType::MARKET_OFFER);
            $this->verify($order->getVolume(), equals, 0.01);
            $this->verify($order->getOutstanding(), equals, 0);
            $this->verify($order->getPrice(), is_null);
            $this->verify($order->getAveragePrice(), equals, 317.13);
            $this->verify($order->getStatus(), equals, OrderStatus::FILLED);
            $this->verify($order->getGuid(), equals, 'ae1e1dc4-a610-4774-9b97-c3a0b453613b');
            $this->verify($order->getPrimaryCurrencyCode(), equals, Currency::XBT);
            $this->verify($order->getSecondaryCurrencyCode(), equals, Currency::USD);
            $found = true;
        }

        $this->assert($found);
    }

    public function testGetOrder()
    {
        $order = $this->client->getOrder('ae1e1dc4-a610-4774-9b97-c3a0b453613b');

        $this->assert($order, instance_of, '\IndependentReserve\Object\Order');
        $this->verify($order->getGuid(), equals, 'ae1e1dc4-a610-4774-9b97-c3a0b453613b');
        $this->verify($order->getCreatedTimestamp(), equals, new DateTime("2014-12-31 23:23:10.644226Z"));
        $this->verify($order->getType(), equals, OrderType::MARKET_OFFER);
        $this->verify($order->getVolumeOrdered(), equals, 0.01);
        $this->verify($order->getVolumeFilled(), equals, 0.01);
        $this->verify($order->getPrice(), is_null);
        $this->verify($order->getReservedAmount(), equals, 0);
        $this->verify($order->getStatus(), equals, OrderStatus::FILLED);
        $this->verify($order->getPrimaryCurrencyCode(), equals, Currency::XBT);
        $this->verify($order->getSecondaryCurrencyCode(), equals, Currency::USD);
    }

    public function testGetAccounts()
    {
        $accounts = $this->client->getAccounts();

        $this->assert(count($accounts), is_greater_than, 0);

        foreach ($accounts as $account) {
            $this->assert($account, instance_of, '\IndependentReserve\Object\Account');
            $this->verify($account->getGuid(), matches_regex, '/[a-f\d]{8}-[a-f\d]{4}-[a-f\d]{4}-[a-f\d]{4}-[a-f\d]{12}/');
            $this->verify($account->getAvailableBalance(), is_numeric);
            $this->verify(strlen($account->getCurrencyCode()), equals, 3);
            $this->verify($account->getTotalBalance(), is_numeric);
        }
    }

    public function testGetTransactions()
    {
        $transactions = $this->client->getTransactions('8945c390-a31f-4044-8ed8-3a18de34cc1d',
            new DateTime('2014-12-31T23:23:05Z'), new DateTime("2014-12-31T23:23:15Z"));
        $this->assert($transactions, instance_of, '\Elliotchance\Iterator\AbstractPagedIterator');

        $this->assert(count($transactions), equals, 1);
        $this->verify($transactions[0]->getSettleTimestamp(), equals, new DateTime("2014-12-31T23:23:10.8002381Z"));
        $this->verify($transactions[0]->getCreatedTimestamp(), equals, new DateTime("2014-12-31T23:23:10.7846213Z"));
        $this->verify($transactions[0]->getType(), equals, TransactionType::TRADE);
        $this->verify($transactions[0]->getStatus(), equals, TransactionStatus::CONFIRMED);
        $this->verify($transactions[0]->getCurrencyCode(), equals, Currency::XBT);
        $this->verify($transactions[0]->getCredit(), is_null);
        $this->verify($transactions[0]->getDebit(), equals, 0.01);
        $this->verify($transactions[0]->getBalance(), is_greater_than, 0);
        $this->verify($transactions[0]->getComment(), is_null);
        $this->verify($transactions[0]->getBitcoinTransactionId(), is_null);
        $this->verify($transactions[0]->getBitcoinTransactionOutputIndex(), is_null);
    }

    public function testGetBitcoinDepositAddress()
    {
        $address = $this->client->getBitcoinDepositAddress();
        $this->assert($address, instance_of, '\IndependentReserve\Object\BitcoinDepositAddress');

        $this->verify($address->getBitcoinAddress(), matches_regex, '/[a-zA-Z0-9]{34}/');
        $this->verify(date, $address->getLastCheckedTimestamp(), is_after, time() - self::DAY);
        $this->verify(date, $address->getNextUpdateTimestamp(), is_after, time() - self::DAY);
    }

    public function testRequestFiatWithdrawal()
    {
        $this->markTestSkipped("This will not be tested.");

        $withdrawal = $this->client->requestFiatWithdrawal(Currency::USD, 100, 'My Bank');
        $this->assert($withdrawal, instance_of, '\IndependentReserve\Object\FiatWithdrawal');
    }
}
