<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::agencySandbox(
    getenv('_TOKEN_')
);

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    new GuzzleHttp\Client()
);

$resp = $client->agencyClients->get(
    ['Archived' => 'NO'],
    ['Login']
);

print_r($resp);
