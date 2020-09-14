<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::buildForSandbox(
    getenv('_LOGIN_'),
    getenv('_TOKEN_'),
    getenv('_MASTER_TOKEN_')
);

$httpClient = new \GuzzleHttp\Client;

$client = new \Gladyshev\Yandex\Direct\Client($credentials, $httpClient);

$report = $client->reports->get(
    /* Selection criteria */
    [
        'Filter'=> [
            [
                'Field' => 'CampaignId',
                'Operator' => 'EQUALS',
                'Values' => 10002
            ]
        ]
    ],

    /* Field names */
    ['Date', 'Clicks', 'Cost', 'AdNetworkType'],

    /* Report name */
    'Campaign #10002, ' . date('M'),

    /* Report type */
    'CUSTOM_REPORT',

    /* Date range type */
    'THIS_MONTH',

    /* Page */
    null,

    /* OrderBy */
    ['Field' => 'Date'],

    /* Include VAT, Include discount, Format */
    'NO', 'NO', 'TSV',

    /* Goals */
    ['20002', '20003']
);


print_r($report);
