Yandex Direct API v5 PHP client
===============================

Удобный PHP-клиент [Yandex.Direct API](https://tech.yandex.ru/direct/doc/dg/concepts/about-docpage/) с поддержкой PSR-7 и PSR-3.

[![Build Status](https://travis-ci.org/gladyshev/yandex-direct-client.svg?branch=master)](https://travis-ci.org/gladyshev/yandex-direct-client)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=master)

## Требования
 * PHP 5.6 и выше

## Установка  
В файле `composer.json`:
```php
{
    ...
    "require": {
        ...
        "gladyshev/yandex-direct-client": "^1.0"
    }
    ...
}
```

## Использование

```php
use Yandex\Direct\Client;

$api = new Client('***login***', '***token***');

$response = $api->campaigns->get(
    ['Ids' => [123545345, 23423234]],  // SelectionCriteria
    ['Status', 'Currency', 'Funds']    // FieldNames
);

print_r($response);
  
// [
//     'request_id' => 1234567890,
//     'units' => [
//         'debit' => 10, 
//         'limit' => 50,
//         'rest' => 100500
//     ],
//     'result' => [...]
// ]
```
