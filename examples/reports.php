<?php

require '../vendor/autoload.php';

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Yandex\Direct\Logger\EchoLog;
use Yandex\Direct\Transport\Json\Transport;

$credentials = new Credentials(getenv('_CLIENT_LOGIN_'), getenv('_TOKEN_'));

$transport = new Transport([
    'baseUrl' => 'https://api-sandbox.direct.yandex.com',
    'logger' => new EchoLog,
]);

$client = new Client($credentials, $transport);

$report = $client->reports->get(
    /* Selection criteria */
    [
        'Filter' => [
            [
                'Field' => 'CampaignId',
                'Operator' => 'EQUALS',
                'Values' => [10002]
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
    [['Field' => 'Date']],

    /* Include VAT */
    'NO',

    /* Include discount */
    'NO',

    /* Format */
    'TSV',

    /* Goals */
    ['20002', '20003']
);

print_r($report);
