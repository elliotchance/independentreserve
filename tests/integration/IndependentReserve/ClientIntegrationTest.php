<?php

namespace IndependentReserve;

use Concise\TestCase;

class ClientIntegrationTest extends TestCase
{
    /**
     * @var Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new Client();
    }

    public function testGetValidPrimaryCurrencyCodes()
    {
        $currencyCodes = $this->client->getValidPrimaryCurrencyCodes();
        $this->assert($currencyCodes, equals, [Currency::XBT]);
    }

    public function testGetValidSecondaryCurrencyCodes()
    {
        $currencyCodes = $this->client->getValidSecondaryCurrencyCodes();
        $this->assert($currencyCodes, has_value, Currency::USD);
    }

    public function testGetValidLimitOrderTypes()
    {
        $orderTypes = $this->client->getGetValidLimitOrderTypes();
        $this->assert($orderTypes, equals, ["LimitBid","LimitOffer"]);
    }

    public function testGetValidMarketOrderTypes()
    {
        $orderTypes = $this->client->getValidMarketOrderTypes();
        $this->assert($orderTypes, equals, ["MarketBid","MarketOffer"]);
    }

    public function testGetMarketSummary()
    {
        $summary = $this->client->getMarketSummary(Currency::XBT, Currency::USD);
        $this->assert($summary, instance_of, '\IndependentReserve\Object\MarketSummary');

        $this->verify($summary->getDayHighestPrice(), is_greater_than, 0);
        $this->verify($summary->getDayLowestPrice(), is_greater_than, 0);
        $this->verify($summary->getDayAveragePrice(), is_between, $summary->getDayLowestPrice(), 'and', $summary->getDayHighestPrice());
        $this->verify($summary->getDayVolumeXbt(), is_greater_than, 0);
        $this->verify($summary->getCurrentLowestOfferPrice(), is_greater_than, 0);
        $this->verify($summary->getCurrentHighestBidPrice(), is_greater_than, 0);
        $this->verify($summary->getLastPrice(), is_greater_than, 0);
        $this->verify($summary->getPrimaryCurrencyCode(), equals, Currency::XBT);
        $this->verify($summary->getSecondaryCurrencyCode(), equals, Currency::USD);
        $this->verify(date, $summary->getCreatedTimestamp(), is_after, time() - 5);
    }

    public function testGetOrderBook()
    {
        $orderBook = $this->client->getOrderBook(Currency::XBT, Currency::USD);
        $this->assert($orderBook, instance_of, '\IndependentReserve\Object\OrderBook');
    }
}
