<?php

use Gladyshev\Yandex\Direct\Exception\ErrorResponseException;
use function GuzzleHttp\Psr7\str;

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::buildForSandbox(
    getenv('_LOGIN_'),
    getenv('_TOKEN_'),
    getenv('_MASTER_TOKEN_')
);

$client = new \Gladyshev\Yandex\Direct\Client(
    $credentials,
    new GuzzleHttp\Client()
);

// just...
//$resp = $client->clients->get([
//     "AccountQuality" ,"Archived", "ClientId", "ClientInfo", "CountryId", "CreatedAt", "Currency", "Grants", "Login", "Notification", "OverdraftSumAvailable", "Phone", "Representatives", "Restrictions", "Settings", "Type", "VatRate"
//]);
try {
    $resp = $client->campaigns->get(['Types' => ['TEXT_CAMPAIGN']], ['Funds']);
    print_r($resp);
} catch (ErrorResponseException $e) {
    echo $e;
}

