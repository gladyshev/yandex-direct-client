<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 10.12.16 16:49
 */

require '../vendor/autoload.php';

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Yandex\Direct\Logger\EchoLog;
use Yandex\Direct\Transport\Json\Transport;

$client = new Client(getenv('_LOGIN_'), getenv('_TOKEN_'));

// For example, change the logger...
$resp = $client
    ->setTransport(new Transport(['logger' => new EchoLog]))
    ->campaigns()
    ->get(['Ids' => [123456, 654321]], ['Funds']);

print_r($resp);

// ...credentials also able to change...
$resp = $client
    ->setCredentials('agrom', '0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f')
    ->campaigns()
    // ...ErrorResponseException because Credentials is wrong...
    ->get(['Ids' => [123456, 654321]], ['Funds']);

// You can change service options with another way...
$resp = $client
    ->campaigns([
        'credentials' => new Credentials('agrom', '0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f0f'),
        'transport' => new Transport(['logger' => new EchoLog])
    ])
    ->get(['Ids' => [123456, 654321]], ['Funds']); // ...same got ErrorResponseException.

// Have a nice code =)
