<?php

namespace IndependentReserve;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Message\Response;
use IndependentReserve\Object\FxRate;
use IndependentReserve\Object\MarketSummary;
use IndependentReserve\Object\OrderBook;
use IndependentReserve\Object\RecentTrades;
use IndependentReserve\Object\TradeHistorySummary;
use stdClass;

class PublicClient
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    public function __construct()
    {
        $this->client = new GuzzleClient();
    }

    /**
     * @param string $url
     * @return mixed
     */
    protected function get($url)
    {
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        /** @var Response $response */
        $response = $this->client->get($url);
        return json_decode($response->getBody());
    }

    /**
     * @param string $endpoint The public endpoint name.
     * @param array $params Optional named parameters.
     * @param string $visibility `Public` or `Private`.
     * @param string $method
     * @return mixed
     */
    public function getEndpoint($endpoint, array $params = array(), $visibility = 'Public',
        $method = 'GET')
    {
        $url = $this->getEndpointUrl($endpoint, $visibility);
        if ('GET' === $method) {
            $query = http_build_query($params);
            return $this->get("$url?$query");
        }

        /** @var \GuzzleHttp\Message\Response $response */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $response = $this->client->post($url, [ 'json' => $params ]);
        return $response->getBody()->getContents();
    }

    public function getEndpointUrl($endpoint, $visibility) {
        return "https://api.independentreserve.com/$visibility/$endpoint";
    }

    /**
     * Returns a list of valid primary currency codes. These are the digital currencies which can be
     * traded on Independent Reserve.
     * @return array
     */
    public function getValidPrimaryCurrencyCodes()
    {
        return $this->getEndpoint('GetValidPrimaryCurrencyCodes');
    }

    /**
     * Returns a list of valid secondary currency codes. These are the fiat currencies which are
     * supported by Independent Reserve for trading purposes.
     * @return array
     */
    public function getValidSecondaryCurrencyCodes()
    {
        return $this->getEndpoint('GetValidSecondaryCurrencyCodes');
    }

    /**
     * Returns a list of valid limit order types which can be placed onto the Independent Reserve
     * exchange platform.
     * @return array
     */
    public function getGetValidLimitOrderTypes()
    {
        return $this->getEndpoint('GetValidLimitOrderTypes');
    }

    /**
     * Returns a list of valid market order types which can be placed onto the Independent Reserve
     * exchange platform.
     * @return array
     */
    public function getValidMarketOrderTypes()
    {
        return $this->getEndpoint('GetValidMarketOrderTypes');
    }

    /**
     * Returns a current snapshot of the Independent Reserve market for a given currency pair.
     * @param string $primaryCurrencyCode The digital currency for which to retrieve market summary.
     *        Must be a valid primary currency, which can be checked via the
     *        getValidPrimaryCurrencyCodes() method.
     * @param string $secondaryCurrencyCode The fiat currency in which to retrieve market summary.
     *        Must be a valid secondary currency, which can be checked via the
     *        getValidSecondaryCurrencyCodes() method.
     * @return MarketSummary
     */
    public function getMarketSummary($primaryCurrencyCode, $secondaryCurrencyCode)
    {
        return MarketSummary::createFromObject($this->getEndpoint('GetMarketSummary', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
        ]));
    }

    /**
     * Returns the Order Book for a given currency pair.
     * @param string $primaryCurrencyCode The digital currency for which to retrieve order book.
     *        Must be a valid primary currency, which can be checked via the
     *        getValidPrimaryCurrencyCodes() method.
     * @param string $secondaryCurrencyCode The fiat currency in which to retrieve order book. Must
     *        be a valid secondary currency, which can be checked via the
     *        getValidSecondaryCurrencyCodes() method.
     * @return OrderBook
     */
    public function getOrderBook($primaryCurrencyCode, $secondaryCurrencyCode)
    {
        return OrderBook::createFromObject($this->getEndpoint('GetOrderBook', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
        ]));
    }

    /**
     * Returns summarised historical trading data for a given currency pair. Data is summarised into
     * 1 hour intervals.
     * @note This method caches return values for 30 minutes. Calling it more than once per 30
     *       minutes will result in cached data being returned.
     * @param string $primaryCurrencyCode The digital currency for which to retrieve the trade
     *        history summary. Must be a valid primary currency, which can be checked via the
     *        getValidPrimaryCurrencyCodes() method.
     * @param string $secondaryCurrencyCode The fiat currency in which to retrieve the trade history
     *        summary. Must be a valid secondary currency, which can be checked via the
     *        getValidSecondaryCurrencyCodes() method.
     * @param int $numberOfHoursInThePastToRetrieve How many past hours of historical summary data
     *        to retrieve (maximum is 240).
     * @return TradeHistorySummary
     */
    public function getTradeHistorySummary($primaryCurrencyCode, $secondaryCurrencyCode,
        $numberOfHoursInThePastToRetrieve)
    {
        return TradeHistorySummary::createFromObject($this->getEndpoint('GetTradeHistorySummary', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'numberOfHoursInThePastToRetrieve' => $numberOfHoursInThePastToRetrieve,
        ]));
    }

    /**
     * Returns a list of most recently executed trades for a given currency pair.
     * @note This method caches return values for 1 second. Calling it more than once per second
     *       will result in cached data being returned.
     * @param string $primaryCurrencyCode The digital currency for which to retrieve recent trades.
     *        Must be a valid primary currency, which can be checked via the
     *        getValidPrimaryCurrencyCodes() method.
     * @param string $secondaryCurrencyCode The fiat currency in which to retrieve recent trades.
     *        Must be a valid secondary currency, which can be checked via the
     *        getValidPrimaryCurrencyCodes() method.
     * @param integer $numberOfRecentTradesToRetrieve How many recent trades to retrieve (maximum
     *        is 50).
     * @return RecentTrades
     */
    public function getRecentTrades($primaryCurrencyCode, $secondaryCurrencyCode,
        $numberOfRecentTradesToRetrieve)
    {
        return RecentTrades::createFromObject($this->getEndpoint('GetRecentTrades', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'numberOfRecentTradesToRetrieve' => $numberOfRecentTradesToRetrieve,
        ]));
    }

    /**
     * Returns a list of exchange rates used by Independent Reserve when depositing funds or
     * withdrawing funds from accounts.
     * @note The rates represent the amount of Currency Code B that can be bought with 1 unit of
     *       Currency Code A.
     * @note This method caches return values for 1 minute. Calling it more than once per minute
     *       will result in cached data being returned.
     * @return FxRate[]
     */
    public function getFxRates()
    {
        return array_map(function (stdClass $object) {
            return FxRate::createFromObject($object);
        }, $this->getEndpoint('GetFxRates'));
    }
}
