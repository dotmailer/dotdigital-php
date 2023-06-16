# PHP SDK for the Dotdigital API

A PHP wrapper for the [Dotdigital API](https://developer.dotdigital.com/docs/getting-started-with-the-api).

## Requirements

* An active account with Dotdigital plus valid API user credentials.
* PHP >= 7.4. We recommend PHP 8 - however the code will run on PHP 7.4 with the correct constraints in your own composer.json.
* A [PSR-7 implementation](https://packagist.org/providers/psr/http-message-implementation)
* A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
* A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## Setup

1. Require this package:
```
composer require dotdigital/dotdigital-php
```
2. Require an HTTP factory implementation from [this list](https://packagist.org/providers/psr/http-factory-implementation), for example:
```
composer require guzzlehttp/psr7
```
3. Require an HTTP client package of your choice from [this list](https://packagist.org/providers/php-http/client-implementation), for example:
```
composer require php-http/curl-client
```

## Example usage

```php
# app/index.php
require_once __DIR__ . '/vendor/autoload.php';

$dotdigital = new \Dotdigital\V3\Client();
$dotdigital::setApiUser('apiuser-123@apiconnector.com');
$dotdigital::setApiPassword('');
$dotdigital::setApiEndpoint('https://r1-api.dotdigital.com');

$accountInfo = $dotdigital->accountInfo->show();
```

## API versions

Dotdigital began releasing endpoints for a new v3 API in May 2023. Initially these endpoints are in public preview, and only available
to merchants with certain Dotdigital account configurations.

- [View v3 API specs on Swagger Hub](https://app.swaggerhub.com/search?owner=Dotdigital)

Currently this SDK wraps both the v2 and the v3 APIs, and will be updated to wrap new v3 endpoints as they become available.

### V2
```
$dotdigital = new \Dotdigital\V2\Client();
```

### V3
```
$dotdigital = new \Dotdigital\V3\Client();
```
