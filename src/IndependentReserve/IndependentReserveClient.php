<?php

namespace IndependentReserve;

class IndependentReserveClient
{
    public function getValidPrimaryCurrencyCodes()
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->get('https://api.independentreserve.com/Public/GetValidPrimaryCurrencyCodes');
        return json_decode($response->getBody());
    }
}
