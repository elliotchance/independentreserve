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
