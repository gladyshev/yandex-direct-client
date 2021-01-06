Yandex Direct API v5 PHP client
===============================

Современный и удобный PHP-клиент [Yandex.Direct API](https://tech.yandex.ru/direct/doc/dg/concepts/about-docpage/). 

[![Build Status](https://travis-ci.org/gladyshev/yandex-direct-client.svg?branch=v4.x)](https://travis-ci.org/gladyshev/yandex-direct-client)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/coverage.png?b=v4.x)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=v4.x)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/quality-score.png?b=v4.x)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=v4.x)

## Требования
 * PHP 7.2 и выше

## Установка  
В файле `composer.json`:
```bash
$ composer require gladyshev/yandex-direct-client
```

## Использование

```php
$credentials = \Gladyshev\Yandex\Direct\Credentials::client(
    getenv('_TOKEN_')
); 

$httpClient = new \GuzzleHttp\Client();

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    $httpClient
);

$response = $client->campaigns->get(
    ['Ids' => [123545345, 23423234]],  // SelectionCriteria
    ['Status', 'Currency', 'Funds']    // FieldNames
);

print_r($response);

// [
//     'request_id' => 8695244274068608439,
//     'units_used_login' => 'ttt-agency',
//     'units' => [
//         'debit' => 10, 
//         'rest' => 20828,
//         'limit' => 64000
//     ],
//     'result' => [...]
// ]
```
