Yandex Direct API v5 PHP client
===============================

Современный и удобный PHP-клиент [Yandex.Direct API](https://tech.yandex.ru/direct/doc/dg/concepts/about-docpage/). 

[![Build Status](https://travis-ci.org/gladyshev/yandex-direct-client.svg?branch=master)](https://travis-ci.org/gladyshev/yandex-direct-client)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=master)

## Требования
 * PHP 7.2 и выше

## Установка  
В файле `composer.json`:
```bash
$ composer require gladyshev/anticaptcha-client
```

## Использование

```php
$credentials = \Gladyshev\Yandex\Direct\ClientCredentials::build(
    getenv('__LOGIN__'),
    getenv('__TOKEN__')
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

var_dump($response);
```
