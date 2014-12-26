IndependentReserve
==================

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
$client = new \IndependentReserve\Client();
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

None of the private APIs are currently supported. I am waiting on my account to be approved to get the API key.
