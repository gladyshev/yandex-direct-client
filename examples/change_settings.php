<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 10.12.16 16:49
 */

require '../vendor/autoload.php';

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Yandex\Direct\Logger\EchoLog;
use Yandex\Direct\Transport\JsonTransport;

$client = new Client(new Credentials(getenv('_LOGIN_'), getenv('_TOKEN_')));

// For example, change the logger
$resp = $client->campaigns([
    'transport' => new JsonTransport([
        'logger' => new EchoLog
    ])
])->get(['Ids' => [123456, 654321]], ['Funds']);

print_r($resp);

// Credentials also able to change
$resp = $client->campaigns([
    'credentials' => new Credentials('agrom', '0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f')
])->get(['Ids' => [123456, 654321]], ['Funds']);

print_r($resp);