IndependentReserve
==================

[![Build Status](https://travis-ci.org/elliotchance/independentreserve.svg?branch=master)](https://travis-ci.org/elliotchance/independentreserve)
[![Coverage Status](https://img.shields.io/coveralls/elliotchance/independentreserve.svg)](https://coveralls.io/r/elliotchance/independentreserve)
[![Latest Stable Version](https://poser.pugx.org/elliotchance/independentreserve/v/stable.svg)](https://packagist.org/packages/elliotchance/independentreserve)
[![Total Downloads](https://poser.pugx.org/elliotchance/independentreserve/downloads.svg)](https://packagist.org/packages/elliotchance/independentreserve)
[![License](https://poser.pugx.org/elliotchance/independentreserve/license.svg)](https://packagist.org/packages/elliotchance/independentreserve)

PHP API for [independentreserve.com](https://www.independentreserve.com)

Installation
------------

Using [composer](https://getcomposer.org):

```
composer require elliotchance/independentreserve
```

Public APIs
-----------

All public APIs are supported, and do not need authentication:

```php
use IndependentReserve\PublicClient;
use IndependentReserve\Currency;

$client = new PublicClient();
$marketSummary = $client->getMarketSummary(Currency::XBT, Currency::USD);
printf('%s: %s USD',
    $marketSummary->getCreatedTimestamp()->format('r'),
    $marketSummary->getDayAveragePrice()
);

// Fri, 26 Dec 2014 05:03:34 +0000: 323.21 USD
```

View all of the public APIs at https://www.independentreserve.com/API#public

Private APIs
------------

All private APIs are available. You must use your API key and secret to access them:

```php
use IndependentReserve\PrivateClient;
use IndependentReserve\Currency;

$client = new PrivateClient('api_key', 'api_secret');
$address = $client->getBitcoinDepositAddress();
echo $address->getBitcoinAddress();

// 12a7FbBzSGvJd36wNesAxAksLXMWm4oLUJ
```

View all of the private APIs at https://www.independentreserve.com/API#private

All of the public API methods are accessible through the `PrivateClient` as well:

```php
$client = new PrivateClient('api_key', 'api_secret');
$marketSummary = $client->getMarketSummary(Currency::XBT, Currency::USD);
```

### Paging Results

Some of the APIs return their results as paged calls (25 items at a time), you do not need to
worry about this because these APIs use
[elliotchance/iterator](https://github.com/elliotchance/iterator) which will handle all the paged
requests for you on demand, you may use all results as an active array:

```php
$client = new PrivateClient('api_key', 'api_secret');
$openOrders = $client->getOpenOrders();

echo count($openOrders);
// 452

var_dump($openOrders[135]); // 136th order

foreach ($openOrders as $order) {
    // ...
}
```
