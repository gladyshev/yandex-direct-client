<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 10.12.16 16:10
 */

require '../vendor/autoload.php';

use Yandex\Direct\Client;
use Yandex\Direct\Credentials;
use Yandex\Direct\Logger\EchoLog;
use Yandex\Direct\Transport\JsonTransport;

$credentials = new Credentials(getenv('_LOGIN_'), getenv('_TOKEN_'));

$transport = new JsonTransport([
    'baseUrl' => 'https://api-sandbox.direct.yandex.com',
    'logger' => new EchoLog
]);

$client = new Client($credentials, ['transport' => $transport]);

$resp = $client->campaigns->get(['Ids' => [123456, 654321]], ['Funds']);

print_r($resp);