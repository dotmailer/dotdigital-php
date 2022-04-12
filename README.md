## Requirements

* PHP >= 7.2
* A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
* A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## Setup

For local development, it is expected that you have a folder structure like:
```
/app
    index.php
/dotdigital-php
```

You should run the following commands:
```
composer init
composer config repositories.dotdigital-php path ../dotdigital-php
composer require dotdigital/dotdigital-php:dev-develop guzzlehttp/guzzle php-http/guzzle7-adapter
```

## Example usage

```php
# app/index.php

$dotdigital = new \Dotdigital\Client();
$dotdigital::setApiUser('apiuser-123@apiconnector.com');
$dotdigital::setApiPassword('');
$dotdigital::setApiEndpoint('https://r1-api.dotmailer.com');

$accountInfo = $dotdigital->accountInfo->show();
```
