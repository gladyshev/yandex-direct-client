<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::agencySandbox(
    getenv('_TOKEN_')
);

$httpFactory = new GuzzleHttp\Psr7\HttpFactory();

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    new GuzzleHttp\Client(),
    $httpFactory,
    $httpFactory
);

$resp = $client->agencyClients->get(
    ['Archived' => 'NO'],
    ['Login']
);

print_r($resp);
