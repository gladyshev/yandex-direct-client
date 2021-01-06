<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::clientSandbox(
    getenv('_TOKEN_')
);

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    new GuzzleHttp\Client()
);

$resp = $client->campaigns->get(
    ['Types' => ['TEXT_CAMPAIGN']],
    ['Name', 'Funds', 'ClientInfo']
);

print_r($resp);
