<?php

require '../vendor/autoload.php';

use Gladyshev\Yandex\Direct\Client;
use Gladyshev\Yandex\Direct\Credentials;


$credentials = new Credentials(
    getenv('_LOGIN_'),
    getenv('_TOKEN_'),
    '',
    true,
    Credentials::LANGUAGE_RU,
    'https://api-sandbox.direct.yandex.com'
);

$client = new Client($credentials, new \GuzzleHttp\Client);

$resp = $client->campaigns->get(['Ids' => [123456, 654321]], ['Funds']);

print_r($resp);