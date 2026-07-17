<?php

require '../vendor/autoload.php';

$credentials = \Gladyshev\Yandex\Direct\Credentials::clientSandbox(
    getenv('_TOKEN_')
);

$httpClient = new \GuzzleHttp\Client;
$httpFactory = new \GuzzleHttp\Psr7\HttpFactory;

$client = new \Gladyshev\Yandex\Direct\Client($credentials, $httpClient, $httpFactory, $httpFactory);

$report = $client->reports->get(
    /* SelectionCriteria */
    [
        'Filter' => [
            [
                'Field' => 'CampaignId',
                'Operator' => 'EQUALS',
                'Values' => [10002]
            ]
        ]
    ],

    /* FieldNames */
    ['Date', 'Clicks', 'Cost', 'AdNetworkType'],

    /* ReportName */
    'Campaign #10002, ' . date('M'),

    /* ReportType */
    'CUSTOM_REPORT',

    /* DateRangeType */
    'THIS_MONTH',

    /* Page */
    null,

    /* OrderBy */
    null,

    /* IncludeVAT */
    'NO',

    /* IncludeDiscount */
    'NO',

    /* Format */
    'TSV',

    /* Goals */
    ['20002', '20003']
);

print_r($report);
