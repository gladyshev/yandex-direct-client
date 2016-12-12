Yandex Direct API v5 PHP client
===============================

Поддерживается только 5-ая версия [Yandex.Direct API](https://tech.yandex.ru/direct/doc/dg/concepts/about-docpage/).

[![Build Status](https://travis-ci.org/gladyshev/yandex-direct-client.svg?branch=master)](https://travis-ci.org/gladyshev/yandex-direct-client)
[![Scrutinizer Code Coverage](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/gladyshev/yandex-direct-client/?branch=master)

### Требования
 * PHP 5.6 и выше с curl-расширением

### Установка  
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

### Использование

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
//     'units' => [
//         'debit' => 10, 
//         'limit' => 50,
//         'rest' => 100500
//     ],
//     'result' => [...]
// ]
```