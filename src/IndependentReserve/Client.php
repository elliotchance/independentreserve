<?php

namespace IndependentReserve;

use DateTime;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Message\Response;
use IndependentReserve\Object\Account;
use IndependentReserve\Object\BitcoinDepositAddress;
use IndependentReserve\Object\ClosedOrder;
use IndependentReserve\Object\FxRate;
use IndependentReserve\Object\MarketSummary;
use IndependentReserve\Object\OpenOrder;
use IndependentReserve\Object\Order;
use IndependentReserve\Object\OrderBook;
use IndependentReserve\Object\PagedIterator;
use IndependentReserve\Object\RecentTrades;
use IndependentReserve\Object\TradeHistorySummary;
use IndependentReserve\Object\Transaction;
use stdClass;

class Client
{
    /**
     * @var GuzzleClient
     */
    protected $client;

    /**
     * @var string
     */
    protected $apiKey;

    /**
     * @var string
     */
    protected $apiSecret;

    /**
     * @param string $apiKey
     * @param string $apiSecret
     */
    public function __construct($apiKey = '', $apiSecret = '')
    {
        $this->client = new GuzzleClient();
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
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
        $url = "https://api.independentreserve.com/$visibility/$endpoint";
        if ('GET' === $method) {
            $query = http_build_query($params);
            return $this->get("$url?$query");
        }

        /** @var \GuzzleHttp\Message\Response $response */
        /** @noinspection PhpVoidFunctionResultUsedInspection */
        $response = $this->client->post($url, [ 'json' => $params ]);
        return $response->getBody()->getContents();
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

    /**
     * Get the components required to make private API calls.
     * @return array
     */
    public function getSignature()
    {
        $nonce = sprintf('%ld', microtime(true) * 1e9);
        $signature = strtoupper(hash_hmac('sha256', $nonce . $this->apiKey, $this->apiSecret));

        return [
            'apiKey' => $this->apiKey,
            'nonce' => $nonce,
            'signature' => $signature,
        ];
    }

    /**
     * Fetch a private API.
     * @param string $endpoint
     * @param array $params
     * @return mixed
     */
    public function getPrivateEndpoint($endpoint, array $params = array())
    {
        return $this->getEndpoint($endpoint, $this->getSignature() + $params, 'Private', 'POST');
    }

    /**
     * Retrieves your currently Open and Partially Filled orders.
     * @param string $primaryCurrencyCode The primary currency of orders.
     * @param string $secondaryCurrencyCode The secondary currency of orders.
     * @return OpenOrder[]
     */
    public function getOpenOrders($primaryCurrencyCode, $secondaryCurrencyCode)
    {
        return new PagedIterator($this, 'GetOpenOrders', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'pageSize' => 25,
        ], function (stdClass $object) {
            return OpenOrder::createFromObject($object);
        });
    }

    /**
     * Places new limit bid / offer order. A Limit Bid is a buy order and a Limit Offer is a sell
     * order.
     * @param string $primaryCurrencyCode The digital currency code of limit order. Must be a valid
     *        primary currency, which can be checked via the getValidPrimaryCurrencyCodes() method.
     * @param string $secondaryCurrencyCode The fiat currency of limit order. Must be a valid
     *        secondary currency, which can be checked via the getValidSecondaryCurrencyCodes()
     *        method.
     * @param string $orderType The type of limit order. Must be a valid limit order type, which can
     *        be checked via the getValidLimitOrderTypes() method.
     * @param double $price The price in secondary currency to buy/sell.
     * @param double $volume The volume to buy/sell in primary currency.
     * @return Order
     */
    public function placeLimitOrder($primaryCurrencyCode, $secondaryCurrencyCode, $orderType,
        $price, $volume)
    {
        return Order::createFromObject($this->getPrivateEndpoint('PlaceLimitOrder', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'price' => $price,
            'volume' => $volume,
            'orderType' => $orderType,
        ]));
    }

    /**
     * Place new market bid / offer order. A Market Bid is a buy order and a Market Offer is a sell
     * order.
     * @param string $primaryCurrencyCode The digital currency code of market order. Must be a valid
     *        primary currency, which can be checked via the getValidPrimaryCurrencyCodes() method.
     * @param string $secondaryCurrencyCode The fiat currency of market order. Must be a valid
     *        secondary currency, which can be checked via the getValidSecondaryCurrencyCodes()
     *        method.
     * @param string $orderType The type of market order. Must be a valid market order type, which
     *        can be checked via the getValidMarketOrderTypes() method.
     * @param double $volume The volume to buy/sell in primary currency.
     * @return Order
     */
    public function placeMarketOrder($primaryCurrencyCode, $secondaryCurrencyCode, $orderType,
        $volume)
    {
        return Order::createFromObject($this->getPrivateEndpoint('PlaceMarketOrder', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'volume' => $volume,
            'orderType' => $orderType,
        ]));
    }

    /**
     * Cancels a previously placed order.
     * @note The order must be in either 'Open' or 'PartiallyFilled' status to be valid for
     *       cancellation. You can retrieve list of Open and Partially Filled orders via the
     *       getOpenOrders() method. You can also check an individual order's status by calling the
     *       getOrderDetails() method.
     * @param string $guid The guid of currently open or partially filled order.
     * @return Order
     */
    public function cancelOrder($guid)
    {
        return Order::createFromObject($this->getPrivateEndpoint('CancelOrder', [
            'orderGuid' => $guid,
        ]));
    }

    /**
     * Retrieves your Closed and Cancelled orders.
     * @param string $primaryCurrencyCode The primary currency of orders.
     * @param string $secondaryCurrencyCode The secondary currency of orders.
     * @return ClosedOrder[]
     */
    public function getClosedOrders($primaryCurrencyCode, $secondaryCurrencyCode)
    {
        return new PagedIterator($this, 'GetClosedOrders', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'pageSize' => 25,
        ], function (stdClass $object) {
            return ClosedOrder::createFromObject($object);
        });
    }

    /**
     * Retrieves your Closed orders which have had some or all of their outstanding volume filled.
     * @param string $primaryCurrencyCode The primary currency of orders.
     * @param string $secondaryCurrencyCode The secondary currency of orders.
     * @return ClosedOrder[]
     */
    public function getClosedFilledOrders($primaryCurrencyCode, $secondaryCurrencyCode)
    {
        return new PagedIterator($this, 'GetClosedFilledOrders', [
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'pageSize' => 25,
        ], function (stdClass $object) {
            return ClosedOrder::createFromObject($object);
        });
    }

    /**
     * Retrieves a single order.
     * @param string $guid
     * @return Order
     */
    public function getOrder($guid)
    {
        return Order::createFromObject(json_decode($this->getPrivateEndpoint('GetOrderDetails', [
            'orderGuid' => $guid,
        ])));
    }

    /**
     * Retrieves information about your Independent Reserve accounts in digital and fiat currencies.
     * @return Account[]
     */
    public function getAccounts()
    {
        return array_map(function (stdClass $object) {
            return Account::createFromObject($object);
        }, json_decode($this->getPrivateEndpoint('GetAccounts')));
    }

    /**
     *
     * @param $accountGuid Account GUID.
     * @param DateTime $from Optional start time.
     * @param DateTime $to Optional end time.
     * @return Transaction[]
     */
    public function getTransactions($accountGuid, DateTime $from = null, DateTime $to = null)
    {
        $format = 'Y-m-d\TH:i:s\Z';
        return new PagedIterator($this, 'GetTransactions', [
            'accountGuid' => $accountGuid,
            'fromTimestampUtc' => $from ? $from->format($format) : null,
            'toTimestampUtc' => $to ? $to->format($format) : null,
            'pageSize' => 25,
        ], function (stdClass $object) {
            return Transaction::createFromObject($object);
        });
    }

    /**
     * Retrieves the Bitcoin address which should be used for new Bitcoin deposits.
     * @return BitcoinDepositAddress
     */
    public function getBitcoinDepositAddress()
    {
        return BitcoinDepositAddress::createFromObject(json_decode($this->getPrivateEndpoint('GetBitcoinDepositAddress')));
    }
}
