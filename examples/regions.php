<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::clientSandbox(
    getenv('_TOKEN_')
);

$httpFactory = new GuzzleHttp\Psr7\HttpFactory();

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    new GuzzleHttp\Client(),
    $httpFactory,
    $httpFactory
);

$resp = $client->dictionaries->get(['GeoRegions']);

print_r($resp);
