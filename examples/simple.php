<?php
/**
 * @author Dmitry Gladyshev <deel@email.ru>
 * @created 07.11.16 12:38
 */

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

$resp = $client->campaigns()->get(['Types' => ['TEXT_CAMPAIGN']], ['Funds']);

print_r($resp);