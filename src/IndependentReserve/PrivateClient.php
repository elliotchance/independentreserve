<?php

namespace IndependentReserve;

use DateTime;
use IndependentReserve\Object\Account;
use IndependentReserve\Object\BitcoinDepositAddress;
use IndependentReserve\Object\ClosedOrder;
use IndependentReserve\Object\FiatWithdrawal;
use IndependentReserve\Object\OpenOrder;
use IndependentReserve\Object\Order;
use IndependentReserve\Object\PagedIterator;
use IndependentReserve\Object\Transaction;
use stdClass;

class PrivateClient extends PublicClient
{
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
    public function __construct($apiKey, $apiSecret)
    {
        parent::__construct();
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
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
        $result = json_decode($this->getPrivateEndpoint('GetBitcoinDepositAddress'));
        return BitcoinDepositAddress::createFromObject($result);
    }

    /**
     * Creates a withdrawal request for a Fiat currency withdrawal from your Independent Reserve
     * account to an external bank account.
     *
     * Withdrawals to Australian bank accounts will be converted into AUD by Independent Reserve at
     * a competitive exchange rate. International withdrawals will be transmitted in USD, and
     * converted into the appropriate currency by the receiving bank. Minimum withdrawal amount is
     * USD 50.00, except where the available balance is less than this amount. In all cases, the
     * withdrawal amount must be greater than the withdrawal fee (only applies to international
     * withdrawals). Withdrawals are manually approved. Please allow 2-3 business days for the funds
     * to arrive in your bank account. Withdrawals to Australian accounts are usually faster.
     * Independent Reserve can only process withdrawals to bank accounts that match the name of the
     * Independent Reserve account holder.
     *
     * @param string $secondaryCurrencyCode The Independent Reserve fiat currency account to
     *        withdraw from (currently only USD accounts are supported).
     * @param double $withdrawalAmount Amount of fiat currency to withdraw.
     * @param string $withdrawalBankAccountName A pre-configured bank account you've already linked
     *        to your Independent Reserve account.
     * @return FiatWithdrawal
     */
    public function requestFiatWithdrawal($secondaryCurrencyCode, $withdrawalAmount,
        $withdrawalBankAccountName)
    {
        $result = json_decode($this->getPrivateEndpoint('GetBitcoinDepositAddress', [
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
            'withdrawalAmount' => $withdrawalAmount,
            'withdrawalBankAccountName' => $withdrawalBankAccountName,
        ]));
        return FiatWithdrawal::createFromObject($result);
    }
}
