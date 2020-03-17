<?php

namespace IndependentReserve;

use Concise\TestCase;

class ClientIntegrationPublicTest extends TestCase
{
    /**
     * @var PublicClient
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->client = new PublicClient();
    }

    public function testGetValidPrimaryCurrencyCodes()
    {
        $currencyCodes = $this->client->getValidPrimaryCurrencyCodes();
        $this->assert($currencyCodes, equals, [Currency::XBT, Currency::ETH, Currency::XRP, Currency::BCH, Currency::BSV, Currency::USDT, Currency::LTC, Currency::EOS, Currency::XLM, Currency::ETC, Currency::BAT, Currency::OMG, Currency::REP, Currency::ZRX, Currency::GNT, Currency::PLA]);
    }

    public function testGetValidSecondaryCurrencyCodes()
    {
        $currencyCodes = $this->client->getValidSecondaryCurrencyCodes();
        $this->assert($currencyCodes, equals, [Currency::AUD, Currency::USD, Currency::NZD]);
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

        $this->verify(date, $orderBook->getCreatedTimestamp(), is_after, time() - 5);
        $this->verify(count($orderBook->getBuyOrders()), greater_than, 0);
        $this->verify(count($orderBook->getSellOrders()), greater_than, 0);
        $this->verify($orderBook->getPrimaryCurrencyCode(), equals, Currency::XBT);
        $this->verify($orderBook->getSecondaryCurrencyCode(), equals, Currency::USD);
    }

    public function testGetTradeHistorySummary()
    {
        $tradeHistorySummary = $this->client->getTradeHistorySummary(Currency::XBT, Currency::USD, 3);
        $this->assert($tradeHistorySummary, instance_of, '\IndependentReserve\Object\TradeHistorySummary');

        $this->verify(date, $tradeHistorySummary->getCreatedTimestamp(), is_after, time() - 86400);
        $this->verify($tradeHistorySummary->getNumberOfHoursInThePastToRetrieve(), equals, 3);
        $this->verify($tradeHistorySummary->getPrimaryCurrencyCode(), equals, Currency::XBT);
        $this->verify($tradeHistorySummary->getSecondaryCurrencyCode(), equals, Currency::USD);
        // $this->verify(count($tradeHistorySummary->getHistorySummaryItems()), equals, 3); 
        // for now IDR API returns data for every hour for past trading day, so, this number is not stable right now
        // maybe a bug on their side
    }

    public function testGetRecentTrades()
    {
        $recentTrades = $this->client->getRecentTrades(Currency::XBT, Currency::USD, 3);
        $this->assert($recentTrades, instance_of, '\IndependentReserve\Object\RecentTrades');

        $this->verify(date, $recentTrades->getCreatedTimestamp(), is_after, time() - 86400);
        $this->verify($recentTrades->getPrimaryCurrencyCode(), equals, Currency::XBT);
        $this->verify($recentTrades->getSecondaryCurrencyCode(), equals, Currency::USD);
        $this->verify(count($recentTrades->getTrades()), equals, 3);
    }

    public function testGetFxRates()
    {
        $fxRates = $this->client->getFxRates();
        $this->assert($fxRates, is_an_array);

        $this->assert($fxRates[0], instance_of, '\IndependentReserve\Object\FxRate');
        $this->verify(strlen($fxRates[0]->getCurrencyCodeA()), equals, 3);
        $this->verify(strlen($fxRates[0]->getCurrencyCodeB()), equals, 3);
        $this->verify($fxRates[0]->getRate(), greater_than, 0);

        $this->assert($fxRates[1], instance_of, '\IndependentReserve\Object\FxRate');
        $this->verify(strlen($fxRates[1]->getCurrencyCodeA()), equals, 3);
        $this->verify(strlen($fxRates[1]->getCurrencyCodeB()), equals, 3);
        $this->verify($fxRates[1]->getRate(), greater_than, 0);
    }
}
