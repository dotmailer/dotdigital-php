## Requirements

* PHP >= 7.2
* A [PSR-17 implementation](https://packagist.org/providers/psr/http-factory-implementation)
* A [PSR-18 implementation](https://packagist.org/providers/psr/http-client-implementation)

## Example usage

```php
$dotdigital = new \Dotdigital\Client();
$dotdigital::setApiUser('apiuser-123@apiconnector.com');
$dotdigital::setApiPassword('');
$dotdigital::setApiEndpoint('https://r1-api.dotmailer.com');

$accountInfo = $dotdigital->api('account-info')->show();
```
