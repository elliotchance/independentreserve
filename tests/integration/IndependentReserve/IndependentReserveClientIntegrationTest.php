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
        $this->assert($summary, is_an_object);

        $this->verify($summary->DayHighestPrice, is_greater_than, 0);
        $this->verify($summary->DayLowestPrice, is_greater_than, 0);
        $this->verify($summary->DayAvgPrice, is_between, $summary->DayLowestPrice, 'and', $summary->DayHighestPrice);
        $this->verify($summary->DayVolumeXbt, is_greater_than, 0);
        $this->verify($summary->CurrentLowestOfferPrice, is_greater_than, 0);
        $this->verify($summary->CurrentHighestBidPrice, is_greater_than, 0);
        $this->verify($summary->LastPrice, is_greater_than, 0);
        $this->verify($summary->PrimaryCurrencyCode, equals, Currency::XBT);
        $this->verify($summary->SecondaryCurrencyCode, equals, Currency::USD);
        $this->verify(date, $summary->CreatedTimestampUtc, is_after, time() - 1);
    }
}
