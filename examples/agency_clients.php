<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\AgencyCredentials::buildForSandbox(
    getenv('_TOKEN_'),
    getenv('_MASTER_TOKEN_'),
    getenv('_CLIENT_LOGIN_')
);

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    new GuzzleHttp\Client()
);

$resp = $client->agencyClients->get(
    ['Archived' => 'YES'],
    ['Login']
);

print_r($resp);
