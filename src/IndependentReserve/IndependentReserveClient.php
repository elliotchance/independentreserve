<?php

namespace IndependentReserve;

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;

class IndependentReserveClient
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
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
     * @return mixed
     */
    protected function getEndpoint($endpoint, array $params = array())
    {
        $query = http_build_query($params);
        return $this->get("https://api.independentreserve.com/Public/$endpoint?$query");
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
     * @return object
     */
    public function getMarketSummary($primaryCurrencyCode, $secondaryCurrencyCode)
    {
        return $this->getEndpoint('GetMarketSummary', array(
            'primaryCurrencyCode' => $primaryCurrencyCode,
            'secondaryCurrencyCode' => $secondaryCurrencyCode,
        ));
    }
}
