Yandex Direct API v5 PHP client
===============================

PHP-клиент [Yandex.Direct API](https://tech.yandex.ru/direct/doc/dg/concepts/about-docpage/) с поддержкой PSR-7 и PSR-3.

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
use Yandex\Direct\Credentials;

$credentials = new Credentials(YOUR_API_LOGIN, YOUR_API_TOKEN);
$api = new Client($credentials);

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

## Contribute
Если вы нашли баг или придумали как что-то улучшить смело делайте fork и pull request с вашими изменениями или создайте issue. 
И, да, не забудте проверить свой код используя [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) на соответствие стандарту [PSR2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) вот таким образом: `$ composer cs-check`.