<?php

require '../vendor/autoload.php';

use Yandex\Direct\Client;

$client = new Client(getenv('_LOGIN_'), getenv('_TOKEN_'));

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
    'NO', 'NO', 'TSV'

    /* Goals */
    ['20002', '20003'],
);


print_r($report);